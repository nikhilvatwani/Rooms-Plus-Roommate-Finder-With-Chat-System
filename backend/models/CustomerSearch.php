<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customer;

/**
 * CustomerSearch represents the model behind the search form about `backend\models\Customer`.
 */
class CustomerSearch extends Customer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contact_no', 'occupation', 'age', 'gender'], 'integer'],
            [['name', 'email', 'interested'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Customer::find();

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
            'id' => $this->id,
            'contact_no' => $this->contact_no,
            'occupation' => $this->occupation,
            'age' => $this->age,
            'gender' => $this->gender,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'interested', $this->interested]);
        $this->changeView($dataProvider->getModels());
        return $dataProvider;
    }

    public function changeView($ids){

    foreach ($ids as $id) {
        if($id->gender == 1)
            $id->gender = 'Female';
        else
            $id->gender = 'Male';
        if($id->occupation == 1)
            $id->occupation = 'Proffesional';
        else
            $id->occupation = 'Student';
            }
        //die();
    }
}
