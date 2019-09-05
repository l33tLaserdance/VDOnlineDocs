<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Cases;
use frontend\models\Devices;

/**
 * CasesSearch represents the model behind the search form of `frontend\models\Cases`.
 */
class CasesSearch extends Cases
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['case_id', 'obj_id', 'case_num', 'order'], 'integer'],
            [['build_num', 'comm_name', 'case_name', 'switch_ip', 'placement', 'expulsion', 'links', 'photo', 'Comment'], 'safe'],
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
        $query = Cases::find();

        // add conditions that should always apply here
		$id = $_GET['id'];
		
		$query = Cases::find()->where(['obj_id' => $id]);
		
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
            'case_id' => $this->case_id,
            'obj_id' => $this->obj_id,
            'case_num' => $this->case_num,
            'expulsion' => $this->expulsion,
            'order' => $this->order,
        ]);

        if (isset($params['search']))
            $query->andWhere(['or',['like', 'case_num', $params['search']], 
		['like', 'build_num', $params['search']], ['like', 'comm_name', $params['search']], 
		['like', 'case_name', $params['search']], ['like', 'switch_ip', $params['search']], 
		['like', 'placement', $params['search']], ['like', 'Comment', $params['search']]]);

        return $dataProvider;
    }
}
