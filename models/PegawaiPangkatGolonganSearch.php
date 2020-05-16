<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiPangkatGolongan;

/**
 * PegawaiPangkatGolonganSearch represents the model behind the search form of `app\models\PegawaiPangkatGolongan`.
 */
class PegawaiPangkatGolonganSearch extends PegawaiPangkatGolongan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_master_pangkat_golongan', 'id_pegawai', 'created_by', 'updated_by'], 'integer'],
            [['tanggal_sk', 'no_sk', 'scan', 'created_date', 'updated_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PegawaiPangkatGolongan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_master_pangkat_golongan' => $this->id_master_pangkat_golongan,
            'id_pegawai' => $this->id_pegawai,
            'tanggal_sk' => $this->tanggal_sk,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'no_sk', $this->no_sk])
            ->andFilterWhere(['like', 'scan', $this->scan]);

        return $dataProvider;
    }
}
