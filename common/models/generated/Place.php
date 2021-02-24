<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type
 * @property int|null $course_type
 * @property string|null $image
 * @property int|null $price
 * @property int|null $oneday_price
 * @property string|null $description
 * @property int|null $capacity
 * @property string|null $start_date
 * @property string|null $end_date
 * @property int|null $seats_number
 * @property string $create_date
 * @property int $status
 * @property int|null $price_unit
 * @property string|null $video
 * @property float|null $price_2
 * @property string|null $small_description
 * @property string|null $text_color
 *
 * @property LocalizedPlace[] $localizedPlaces
 * @property PlaceContents[] $placeContents
 * @property PlaceImage[] $placeImages
 * @property Request[] $requests
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'create_date', 'status'], 'required'],
            [['type', 'course_type', 'price', 'oneday_price', 'capacity', 'seats_number', 'status', 'price_unit'], 'integer'],
            [['description'], 'string'],
            [['start_date', 'end_date', 'create_date'], 'safe'],
            [['price_2'], 'number'],
            [['name', 'image', 'video', 'small_description', 'text_color'], 'string', 'max' => 512],
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
            'course_type' => 'Course Type',
            'image' => 'Image',
            'price' => 'Price',
            'oneday_price' => 'Oneday Price',
            'description' => 'Description',
            'capacity' => 'Capacity',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'seats_number' => 'Seats Number',
            'create_date' => 'Create Date',
            'status' => 'Status',
            'price_unit' => 'Price Unit',
            'video' => 'Video',
            'price_2' => 'Price 2',
            'small_description' => 'Small Description',
            'text_color' => 'Text Color',
        ];
    }

    /**
     * Gets query for [[LocalizedPlaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizedPlaces()
    {
        return $this->hasMany(LocalizedPlace::className(), ['item_id' => 'id']);
    }

    /**
     * Gets query for [[PlaceContents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceContents()
    {
        return $this->hasMany(PlaceContents::className(), ['place_id' => 'id']);
    }

    /**
     * Gets query for [[PlaceImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceImages()
    {
        return $this->hasMany(PlaceImage::className(), ['place_id' => 'id']);
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['place_id' => 'id']);
    }
}
