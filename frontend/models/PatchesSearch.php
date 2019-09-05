<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Patches;

/**
 * PatchesSearch represents the model behind the search form of `frontend\models\Patches`.
 */
class PatchesSearch extends Patches
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_patches', 'patches_type', 'ports'], 'integer'],
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
        $query = Patches::find();

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
            'id_patches' => $this->id_patches,
            'patches_type' => $this->patches_type,
            'ports' => $this->ports,
        ]);

        return $dataProvider;
    }
}