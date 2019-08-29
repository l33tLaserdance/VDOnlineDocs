<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Ups;

/**
 * UpsSearch represents the model behind the search form of `frontend\models\Ups`.
 */
class UpsSearch extends Ups
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ups_id', 'device_id'], 'integer'],
            [['ups_model', 'max_time', 'battery_exchange', 'Comment', 'upscol'], 'safe'],
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
        $query = Ups::find();

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
            'ups_id' => $this->ups_id,
            'device_id' => $this->device_id,
            'battery_exchange' => $this->battery_exchange,
        ]);

        $query->andFilterWhere(['like', 'ups_model', $this->ups_model])
            ->andFilterWhere(['like', 'max_time', $this->max_time])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
            ->andFilterWhere(['like', 'upscol', $this->upscol]);

        return $dataProvider;
    }
}
