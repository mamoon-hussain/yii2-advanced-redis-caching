<?php


namespace common\models\search;

use common\models\User;
use Yii;
use yii\data\ActiveDataProvider;

class UserSearch extends \webvimark\modules\UserManagement\models\search\UserSearch {

    public function rules() {
        return [
            [['id', 'status', 'created_at', 'updated_at', 'email_confirmed'], 'integer'],
            [['username', 'fname', 'lname', 'phone', 'gridRoleSearch', 'registration_ip', 'email'], 'string'],
        ];
    }

    public function search($params) {
        $query = User::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fname' => $this->fname,
            'lname' => $this->lname,
//            'phone' => $this->phone,
            'status' => $this->status,
            'registration_ip' => $this->registration_ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_confirmed' => $this->email_confirmed,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}