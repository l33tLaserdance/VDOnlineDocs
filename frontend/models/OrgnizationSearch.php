<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Organization;

/**
 * OrgnizationSearch represents the model behind the search form of `frontend\models\Organization`.
 */
class OrgnizationSearch extends Organization
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['org_name', 'org_full_name', 'INN', 'org_address', 'Comment', 'photo'], 'safe'],
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
        $query = Organization::find();

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
        ]);

        if (isset($params['search']))
            $query->andWhere(['or',['like', 'org_name', $params['search']], ['like', 'Comment', $params['search']], 
		['like', 'org_full_name', $params['search']], ['like', 'INN', $params['search']], ['like', 'org_address', $params['search']]]);

        return $dataProvider;
    }
}
