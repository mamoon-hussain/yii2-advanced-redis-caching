<?php

namespace common\models\generated\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppInfo;

/**
 * AppInfoSearch represents the model behind the search form of `common\models\AppInfo`.
 */
class AppInfoSearch extends AppInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['description', 'email', 'phone', 'mobile', 'site_url', 'facebook_url', 'instagram_url', 'linkedin_url', 'twitter_url'], 'safe'],
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
        $query = AppInfo::find();

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
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'site_url', $this->site_url])
            ->andFilterWhere(['like', 'facebook_url', $this->facebook_url])
            ->andFilterWhere(['like', 'instagram_url', $this->instagram_url])
            ->andFilterWhere(['like', 'linkedin_url', $this->linkedin_url])
            ->andFilterWhere(['like', 'twitter_url', $this->twitter_url]);

        return $dataProvider;
    }
}
