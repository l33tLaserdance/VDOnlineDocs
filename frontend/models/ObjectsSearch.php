<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Objects;

/**
 * ObjectsSearch represents the model behind the search form of `frontend\models\Objects`.
 */
class ObjectsSearch extends Objects
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['obj_id', 'org_id'], 'integer'],
            [['address', 'obj_name', 'Comment', 'photo', 'map'], 'safe'],
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
        $query = Objects::find();

        // add conditions that should always apply here

		$id = $_GET['id'];
		
		$query = Objects::find()->where(['org_id' => $id]);

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
		if (isset($org_id)) {
			$query->andFilterWhere([
				'org_id' => $org_id,
			]);	
		}
		
        $query->andFilterWhere([
            'obj_id' => $this->obj_id,
            'org_id' => $this->org_id,
        ]);

        $query->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'obj_name', $this->obj_name])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
			->andFilterWhere(['like', 'photo', $this->photo])
			->andFilterWhere(['like', 'map', $this->map]);

        return $dataProvider;
    }
}
