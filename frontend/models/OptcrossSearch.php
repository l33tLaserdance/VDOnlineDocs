<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Optcross;

/**
 * OptcrossSearch represents the model behind the search form of `frontend\models\Optcross`.
 */
class OptcrossSearch extends Optcross
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['optcross_id', 'device_id', 'port'], 'integer'],
            [['optcross_name', 'uplink', 'connected_to', 'Comment'], 'safe'],
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
        $query = Optcross::find();

        // add conditions that should always apply here
		$id = $_GET['id'];
		
		$query = Optcross::find()->where(['device_id' => $id]);

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
            'optcross_id' => $this->optcross_id,
            'device_id' => $this->device_id,
            'port' => $this->port,
        ]);

        $query->andFilterWhere(['like', 'optcross_name', $this->optcross_name])
            ->andFilterWhere(['like', 'uplink', $this->uplink])
            ->andFilterWhere(['like', 'connected_to', $this->connected_to])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
			->andFilterWhere(['like', 'functional', $this->functional]);

        return $dataProvider;
    }
}
