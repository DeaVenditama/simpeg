<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai_pendidikan".
 *
 * @property int $id
 * @property int $id_pegawai
 * @property int $id_tingkat_pendidikan
 * @property string $no_ijazah
 * @property string $scan_ijazah
 * @property string $tahun_lulus
 * @property int $created_by
 * @property string $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 *
 * @property Pegawai $pegawai
 * @property MasterTingkatPendidikan $tingkatPendidikan
 */
class PegawaiPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai_pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pegawai', 'id_tingkat_pendidikan', 'no_ijazah', 'scan_ijazah', 'tahun_lulus', 'created_by', 'created_date'], 'required'],
            [['id_pegawai', 'id_tingkat_pendidikan', 'created_by', 'updated_by'], 'integer'],
            [['no_ijazah', 'scan_ijazah'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['tahun_lulus'], 'string', 'max' => 4],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id']],
            [['id_tingkat_pendidikan'], 'exist', 'skipOnError' => true, 'targetClass' => MasterTingkatPendidikan::className(), 'targetAttribute' => ['id_tingkat_pendidikan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pegawai' => 'Id Pegawai',
            'id_tingkat_pendidikan' => 'Id Tingkat Pendidikan',
            'no_ijazah' => 'No Ijazah',
            'scan_ijazah' => 'Scan Ijazah',
            'tahun_lulus' => 'Tahun Lulus',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id' => 'id_pegawai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTingkatPendidikan()
    {
        return $this->hasOne(MasterTingkatPendidikan::className(), ['id' => 'id_tingkat_pendidikan']);
    }
}
