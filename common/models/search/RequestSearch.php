<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Request;

/**
 * RequestSearch represents the model behind the search form of `common\models\Request`.
 */
class RequestSearch extends \common\models\generated\search\RequestSearch
{
    public function search($params)
    {
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_date' => SORT_DESC]],
        ]);

        //sort
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['product_id' => SORT_ASC,],
            'desc' => ['product_id' => SORT_DESC,],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id,
            'place_id' => $this->place_id,
            'status' => $this->status,
            'created_date' => $this->created_date,
            'enums' => $this->enums,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'fname', $this->fname])
            ->andFilterWhere(['like', 'lname', $this->lname])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
