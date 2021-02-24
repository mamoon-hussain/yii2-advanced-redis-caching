<?php

namespace common\models\generated\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserMobileEmail;

/**
 * UserMobileEmailSearch represents the model behind the search form of `common\models\UserMobileEmail`.
 */
class UserMobileEmailSearch extends UserMobileEmail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'is_confirmed', 'is_primary', 'type'], 'integer'],
            [['mobile', 'email', 'confirm_code', 'symbol'], 'safe'],
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
        $query = UserMobileEmail::find();

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
            'user_id' => $this->user_id,
            'is_confirmed' => $this->is_confirmed,
            'is_primary' => $this->is_primary,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'confirm_code', $this->confirm_code])
            ->andFilterWhere(['like', 'symbol', $this->symbol]);

        return $dataProvider;
    }
}
