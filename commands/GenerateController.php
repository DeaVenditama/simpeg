<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class GenerateController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionAdd($row=20,$iterate=10)
    {
        $start = microtime(true);
        $faker = \Faker\Factory::create();
        $datas = [];
        for($j=1;$j<=$iterate;$j++){
            for($i=1;$i<=$row;$i++){                                     
                $datas[$i]=[
                    $faker->randomNumber($nbDigits = 9, $strict = false),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    $faker->name,
                    $faker->text($maxNbChars = 30),
                    $faker->city,
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    rand(1,6),
                    rand(1,2),
                    rand(1,4),
                    rand(1,2),
                    $faker->address,
                    $faker->phoneNumber,
                    $faker->email,
                    $faker->text($maxNbChars = 30),
                    $faker->text($maxNbChars = 30),
                    $faker->dateTimeThisCentury->format('Y-m-d'),
                    1
                ];
            }   
            \Yii::$app->db->createCommand()->batchInsert('pegawai', ['nip', 'tmt', 'nama', 'foto', 'tempat_lahir', 'tanggal_lahir', 'agama', 'jenis_kelamin', 'nikah', 'status_pegawai', 'alamat','telepon','email','salt','password','created_date','created_by'], $datas)->execute();
        }   
         
        $time_elapsed_us = microtime(true) - $start;
        echo ($row*$iterate).' = '.$time_elapsed_us.' <br>';
    }
    public function actionAddPangkatPendidikan($max_id_pegawai = 204, $data = 200)
    {
        $faker = \Faker\Factory::create();
        $dataPangkat = [];
        $dataPendidikan = [];
        for($i=1;$i<=$data;$i++){
            $dataPangkat[$i]=[
                rand(1,17),
                rand(4, $max_id_pegawai),
                $faker->dateTimeThisCentury->format('Y-m-d'),
                $faker->randomNumber($nbDigits = 9, $strict = false),
                $faker->text($maxNbChars = 30),
                1,
                date("Y-m-d H:i:s")
            ];

            $dataPendidikan[$i]=[
                rand(4, $max_id_pegawai),
                rand(1,4),
                $faker->randomNumber($nbDigits = 9, $strict = false),
                $faker->text($maxNbChars = 30),
                $faker->dateTimeThisCentury->format('Y'),
                1,
                date("Y-m-d H:i:s")
            ];

            echo $i.'\n';
        }
        \Yii::$app->db->createCommand()->batchInsert('pegawai_pangkat_golongan', ['id_master_pangkat_golongan', 'id_pegawai', 'tanggal_sk', 'no_sk', 'scan', 'created_by', 'created_date'], $dataPangkat)->execute();

        \Yii::$app->db->createCommand()->batchInsert('pegawai_pendidikan', ['id_pegawai', 'id_tingkat_pendidikan', 'no_ijazah', 'scan_ijazah', 'tahun_lulus', 'created_by', 'created_date'], $dataPendidikan)->execute();
    }
}
