<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_tingkat_pendidikan".
 *
 * @property int $id
 * @property string $nama
 * @property string $nama_short
 *
 * @property PegawaiPendidikan[] $pegawaiPendidikans
 */
class MasterTingkatPendidikan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_tingkat_pendidikan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'nama_short'], 'required'],
            [['nama'], 'string'],
            [['nama_short'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'nama_short' => 'Nama Short',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawaiPendidikans()
    {
        return $this->hasMany(PegawaiPendidikan::className(), ['id_tingkat_pendidikan' => 'id']);
    }
}
