<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\PatchPanel;

/**
 * PatchpanelSearch represents the model behind the search form of `frontend\models\PatchPanel`.
 */
class PatchpanelSearch extends PatchPanel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patch_id', 'device_id', 'ports'], 'integer'],
            [['patch_name', 'model', 'ip', 'Comment'], 'safe'],
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
        $query = PatchPanel::find();

        // add conditions that should always apply here
		$id = $_GET['id'];
		
		$query = PatchPanel::find()->where(['device_id' => $id]);

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
            'patch_id' => $this->patch_id,
            'device_id' => $this->device_id,
            'ports' => $this->ports,
        ]);

        $query->andFilterWhere(['like', 'patch_name', $this->patch_name])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'Comment', $this->Comment])
			->andFilterWhere(['like', 'functional', $this->functional]);

        return $dataProvider;
    }
}
