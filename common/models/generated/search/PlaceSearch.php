<?php

namespace common\models\generated\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Place;

/**
 * PlaceSearch represents the model behind the search form of `common\models\Place`.
 */
class PlaceSearch extends Place
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type', 'price', 'oneday_price', 'capacity', 'seats_number', 'status'], 'integer'],
            [['name', 'image', 'description', 'contents', 'start_date', 'end_date','create_date'], 'safe'],
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
    public function search($params,$query)
    {
        if(!$query)
        {
            $query = Place::find();
        }


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
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
            'price' => $this->price,
            'oneday_price' => $this->oneday_price,
            'capacity' => $this->capacity,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'seats_number' => $this->seats_number,
            'create_date' => $this->create_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description]);
        return $dataProvider;
    }
}
