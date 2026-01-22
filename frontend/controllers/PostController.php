<?php

namespace frontend\controllers;

use common\enums\ActiveInactiveStatus;
use common\enums\Constents;
use common\enums\PaintingToolType;
use common\models\Category;
use common\models\Comment;
use common\models\Post;
use common\models\ProductFrames;
use common\models\search\ProductFramesSearch;
use Yii;
use common\models\Product;
use common\models\search\ProductSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\enums\PlaceType;
use yii\filters\AccessControl;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class PostController extends \common\utils\Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $cacheKey = 'frontend_posts_list';
        $posts = Yii::$app->cache->get($cacheKey);
        if ($posts === false) {
            $posts = Post::find()->where(['status' => 1])->all();
            Yii::$app->cache->set($cacheKey, $posts, 600);
        }

        return $this->render('index', [
            'posts' => $posts,
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);

        $viewKey = 'post_views_' . $model->id;
        $views = Yii::$app->cache->get($viewKey) ?: $model->views;
        $views++;
        Yii::$app->cache->set($viewKey, $views, 3600);
        $model->views = $views;
        $model->save();

        $commentsCacheKey = 'post_comments_' . $model->id;
        $comments = Yii::$app->cache->get($commentsCacheKey);
        if ($comments === false) {
            $comments = Comment::find()->where(['post_id' => $id])->all();
            Yii::$app->cache->set($commentsCacheKey, $comments, 600);
        }

        return $this->render('view', [
            'model' => $model,
            'comments' => $comments,
        ]);
    }


    protected function findModel($id)
    {
        return Post::findOne($id);
    }

}
