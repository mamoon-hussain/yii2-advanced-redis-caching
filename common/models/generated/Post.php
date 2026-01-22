<?php

namespace common\models\generated;

use common\models\Admin;
use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $author_id
 * @property int|null $category_id
 * @property int|null $views
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $image
 * @property string|null $video
 * @property string|null $url
 * @property int $status
 *
 * @property Admin $author
 * @property Category $category
 * @property Comment[] $comments
 */
class Post extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'image', 'video', 'url'], 'default', 'value' => null],
            [['views'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['title', 'content', 'author_id'], 'required'],
            [['content'], 'string'],
            [['author_id', 'category_id', 'views', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
            [['video', 'url'], 'string', 'max' => 100],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Admin::class, 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'author_id' => 'Author ID',
            'category_id' => 'Category ID',
            'views' => 'Views',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'image' => 'Image',
            'video' => 'Video',
            'url' => 'Url',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Admin::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

}
