<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Responsible;

/**
 * ResponsibleSearch represents the model behind the search form of `frontend\models\Responsible`.
 */
class ResponsibleSearch extends Responsible
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resp_id'], 'integer'],
            [['resp_FIO', 'resp_phone', 'resp_email'], 'safe'],
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
        $query = Responsible::find();

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
            'resp_id' => $this->resp_id,
        ]);
		
		if (isset($params['search']))
            $query->andWhere(['or',['like', 'resp_FIO', $params['search']], 
		['like', 'resp_phone', $params['search']], ['like', 'resp_email', $params['search']]]);

        return $dataProvider;
    }
}
