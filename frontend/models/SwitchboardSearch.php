<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Switchboard;

/**
 * SwitchboardSearch represents the model behind the search form of `frontend\models\Switchboard`.
 */
class SwitchboardSearch extends Switchboard
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['switch_id', 'device_id', 'port'], 'integer'],
            [['switch_name', 'switch_model', 'switch_ip', 'connected_to', 'model_connected_to', 'ip_connected_to', 'Comment'], 'safe'],
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
        $query = Switchboard::find();

        // add conditions that should always apply here
		$id = $_GET['id'];
		
		$query = Switchboard::find()->where(['device_id' => $id]);
		
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
            'switch_id' => $this->switch_id,
            'device_id' => $this->device_id,
            'port' => $this->port,
        ]);

        $query->andFilterWhere(['like', 'switch_name', $this->switch_name])
            ->andFilterWhere(['like', 'switch_model', $this->switch_model])
            ->andFilterWhere(['like', 'switch_ip', $this->switch_ip])
            ->andFilterWhere(['like', 'connected_to', $this->connected_to])
            ->andFilterWhere(['like', 'model_connected_to', $this->model_connected_to])
            ->andFilterWhere(['like', 'ip_connected_to', $this->ip_connected_to])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
			->andFilterWhere(['like', 'functional', $this->functional]);

        return $dataProvider;
    }
}
