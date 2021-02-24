<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "place_image".
 *
 * @property int $id
 * @property int $place_id
 * @property string $image
 *
 * @property Place $place
 */
class PlaceImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_id', 'image'], 'required'],
            [['place_id'], 'integer'],
            [['image'], 'string', 'max' => 512],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('all', 'ID'),
            'place_id' => Yii::t('all', 'Place ID'),
            'image' => Yii::t('all', 'Image'),
        ];
    }

    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }
}
