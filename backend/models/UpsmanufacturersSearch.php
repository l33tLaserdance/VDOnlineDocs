<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UpsManufacturers;

/**
 * UpsmanufacturersSearch represents the model behind the search form of `backend\models\UpsManufacturers`.
 */
class UpsmanufacturersSearch extends UpsManufacturers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_man'], 'integer'],
            [['upsman_name'], 'safe'],
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
        $query = UpsManufacturers::find();

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
            'id_man' => $this->id_man,
        ]);

        $query->andFilterWhere(['like', 'upsman_name', $this->upsman_name]);

        return $dataProvider;
    }
}
