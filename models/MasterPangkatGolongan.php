<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "master_pangkat_golongan".
 *
 * @property int $id
 * @property string $golongan
 * @property string $pangkat
 *
 * @property PegawaiPangkatGolongan[] $pegawaiPangkatGolongans
 */
class MasterPangkatGolongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_pangkat_golongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['golongan', 'pangkat'], 'required'],
            [['pangkat'], 'string'],
            [['golongan'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'golongan' => 'Golongan',
            'pangkat' => 'Pangkat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawaiPangkatGolongans()
    {
        return $this->hasMany(PegawaiPangkatGolongan::className(), ['id_master_pangkat_golongan' => 'id']);
    }
}
