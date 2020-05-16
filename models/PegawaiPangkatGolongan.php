<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai_pangkat_golongan".
 *
 * @property int $id
 * @property int $id_master_pangkat_golongan
 * @property int $id_pegawai
 * @property string $tanggal_sk
 * @property string $no_sk
 * @property string $scan
 * @property int $created_by
 * @property string $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 *
 * @property MasterPangkatGolongan $masterPangkatGolongan
 * @property Pegawai $pegawai
 */
class PegawaiPangkatGolongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai_pangkat_golongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_master_pangkat_golongan', 'id_pegawai', 'tanggal_sk', 'no_sk', 'created_by', 'created_date'], 'required'],
            [['id_master_pangkat_golongan', 'id_pegawai', 'created_by', 'updated_by'], 'integer'],
            [['tanggal_sk', 'created_date', 'updated_date'], 'safe'],
            [['scan'], 'string'],
            [['no_sk'], 'string', 'max' => 30],
            [['id_master_pangkat_golongan'], 'exist', 'skipOnError' => true, 'targetClass' => MasterPangkatGolongan::className(), 'targetAttribute' => ['id_master_pangkat_golongan' => 'id']],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_master_pangkat_golongan' => 'Id Master Pangkat Golongan',
            'id_pegawai' => 'Id Pegawai',
            'tanggal_sk' => 'Tanggal Sk',
            'no_sk' => 'No Sk',
            'scan' => 'Scan',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterPangkatGolongan()
    {
        return $this->hasOne(MasterPangkatGolongan::className(), ['id' => 'id_master_pangkat_golongan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id' => 'id_pegawai']);
    }
}
