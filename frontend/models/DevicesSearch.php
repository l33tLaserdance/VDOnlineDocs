<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Devices;

/**
 * DevicesSearch represents the model behind the search form of `frontend\models\Devices`.
 */
class DevicesSearch extends Devices
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['device_id', 'case_id', 'port', 'device_type'], 'integer'],
            [['device_name', 'device_link', 'Comment'], 'safe'],
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
        $query = Devices::find();

        // add conditions that should always apply here
		$id = $_GET['id'];
		
		$query = Devices::find()->where(['case_id' => $id]);
		
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
            'device_id' => $this->device_id,
            'case_id' => $this->case_id,
            'port' => $this->port,
        ]);

        $query->andFilterWhere(['like', 'device_type', $this->device_type])
            ->andFilterWhere(['like', 'device_name', $this->device_name])
            ->andFilterWhere(['like', 'device_link', $this->device_link])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
			->andFilterWhere(['like', 'device_switchn', $this->device_switchn])
			->andFilterWhere(['like', 'device_ip', $this->device_ip]);

        return $dataProvider;
    }
}
