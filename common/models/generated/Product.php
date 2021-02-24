<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property string|null $image
 * @property int $price
 * @property string $description
 * @property string|null $create_date
 * @property int $status
 * @property int|null $category_id
 * @property string|null $small_description
 * @property string|null $video
 * @property int|null $has_offer
 * @property float|null $old_price
 *
 * @property Category $category
 * @property ProductFrames[] $productFrames
 * @property Request[] $requests
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type', 'price', 'description', 'status'], 'required'],
            [['type', 'price', 'status', 'category_id', 'has_offer'], 'integer'],
            [['description'], 'string'],
            [['create_date'], 'safe'],
            [['old_price'], 'number'],
            [['name', 'image', 'small_description', 'video'], 'string', 'max' => 512],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'image' => 'Image',
            'price' => 'Price',
            'description' => 'Description',
            'create_date' => 'Create Date',
            'status' => 'Status',
            'category_id' => 'Category ID',
            'small_description' => 'Small Description',
            'video' => 'Video',
            'has_offer' => 'Has Offer',
            'old_price' => 'Old Price',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[ProductFrames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductFrames()
    {
        return $this->hasMany(ProductFrames::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['product_id' => 'id']);
    }
}
