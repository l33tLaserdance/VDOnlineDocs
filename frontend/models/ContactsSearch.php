<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Contacts;

/**
 * ContactsSearch represents the model behind the search form of `frontend\models\Contacts`.
 */
class ContactsSearch extends Contacts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'org_id'], 'integer'],
            [['FIO', 'Phone', 'Email', 'Positon', 'Comment'], 'safe'],
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
        $query = Contacts::find();

        // add conditions that should always apply here
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			
			$query = Contacts::find()->where(['org_id' => $id]);
		}
		
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
            'contact_id' => $this->contact_id,
            'org_id' => $this->org_id,
        ]);
			
		if (isset($params['search']))
            $query->andWhere(['or',['like', 'FIO', $params['search']], ['like', 'Comment', $params['search']], 
		['like', 'Phone', $params['search']], ['like', 'Email', $params['search']], ['like', 'Positon', $params['search']]]);

        return $dataProvider;
    }
}
