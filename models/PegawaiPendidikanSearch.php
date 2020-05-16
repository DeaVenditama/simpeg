<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PegawaiPendidikan;

/**
 * PegawaiPendidikanSearch represents the model behind the search form of `app\models\PegawaiPendidikan`.
 */
class PegawaiPendidikanSearch extends PegawaiPendidikan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_pegawai', 'id_tingkat_pendidikan', 'created_by', 'updated_by'], 'integer'],
            [['no_ijazah', 'scan_ijazah', 'tahun_lulus', 'created_date', 'updated_date'], 'safe'],
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
        $query = PegawaiPendidikan::find();

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
            'id_pegawai' => $this->id_pegawai,
            'id_tingkat_pendidikan' => $this->id_tingkat_pendidikan,
            'created_by' => $this->created_by,
            'created_date' => $this->created_date,
            'updated_by' => $this->updated_by,
            'updated_date' => $this->updated_date,
        ]);

        $query->andFilterWhere(['like', 'no_ijazah', $this->no_ijazah])
            ->andFilterWhere(['like', 'scan_ijazah', $this->scan_ijazah])
            ->andFilterWhere(['like', 'tahun_lulus', $this->tahun_lulus]);

        return $dataProvider;
    }
}
