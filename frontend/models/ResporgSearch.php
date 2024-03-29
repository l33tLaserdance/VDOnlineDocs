<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\RespOrg;

/**
 * ResporgSearch represents the model behind the search form of `frontend\models\RespOrg`.
 */
class ResporgSearch extends RespOrg
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'org_id', 'resp_id'], 'integer'],
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
        $query = RespOrg::find();

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
            'org_id' => $this->org_id,
            'resp_id' => $this->resp_id,
        ]);

        return $dataProvider;
    }
}
