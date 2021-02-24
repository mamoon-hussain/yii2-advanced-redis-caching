<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "place_contents".
 *
 * @property int $id
 * @property int $place_id
 * @property string $content
 *
 * @property Place $place
 */
class PlaceContents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_contents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['place_id', 'content'], 'required'],
            [['place_id'], 'integer'],
            [['content'], 'string'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_id' => 'Place ID',
            'content' => 'Content',
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
