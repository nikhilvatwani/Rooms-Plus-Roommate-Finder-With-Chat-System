<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rooms;

/**
 * RoomsSearch represents the model behind the search form about `backend\models\Rooms`.
 */
class RoomsSearch extends Rooms
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'no_of_rooms', 'rent', 'flat_no', 'country', 'state', 'area', 'images'], 'integer'],
            [['building_name', 'description', 'interested', 'created_at'], 'safe'],
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
        $query = Rooms::find();

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
            'type' => $this->type,
            'no_of_rooms' => $this->no_of_rooms,
            'rent' => $this->rent,
            'flat_no' => $this->flat_no,
            'country' => $this->country,
            'state' => $this->state,
            'area' => $this->area,
            'images' => $this->images,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'building_name', $this->building_name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'interested', $this->interested]);

        return $dataProvider;
    }
}
