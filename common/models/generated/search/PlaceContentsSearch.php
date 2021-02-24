<?php

namespace common\models\generated\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PlaceContents;

/**
 * PlaceContentsSearch represents the model behind the search form of `common\models\PlaceContents`.
 */
class PlaceContentsSearch extends PlaceContents
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'place_id'], 'integer'],
            [['content'], 'safe'],
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
        $query = PlaceContents::find();

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
            'place_id' => $this->place_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
