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

        $query->andFilterWhere(['like', 'resp_FIO', $this->resp_FIO])
            ->andFilterWhere(['like', 'resp_phone', $this->resp_phone])
            ->andFilterWhere(['like', 'resp_email', $this->resp_email]);

        return $dataProvider;
    }
}
