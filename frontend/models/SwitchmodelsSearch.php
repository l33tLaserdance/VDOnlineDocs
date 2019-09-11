<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\SwitchModels;

/**
 * SwitchmodelsSearch represents the model behind the search form of `frontend\models\SwitchModels`.
 */
class SwitchmodelsSearch extends SwitchModels
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_switchmod', 'manufacturer', 'ports'], 'integer'],
            [['model', 'PoE', 'control'], 'safe'],
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
        $query = SwitchModels::find();

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
            'id_switchmod' => $this->id_switchmod,
            'manufacturer' => $this->manufacturer,
            'ports' => $this->ports,
        ]);

        $query->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'PoE', $this->PoE])
			->andFilterWhere(['like', 'control', $this->control]);

        return $dataProvider;
    }
}
