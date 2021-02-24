<?php


namespace common\models\search;

use common\models\User;
use webvimark\modules\UserManagement\models\Admin;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class AdminSearch extends \webvimark\modules\UserManagement\models\search\AdminSearch {

    public function rules() {
        return [
            [['id', 'superadmin', 'status', 'created_at', 'updated_at', 'email_confirmed'], 'integer'],
            [['username', 'gridRoleSearch', 'registration_ip', 'email'], 'string'],
        ];
    }

    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params) {
        $query = Admin::find();

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
            'status' => $this->status,
            'registration_ip' => $this->registration_ip,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'email_confirmed' => $this->email_confirmed,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

}