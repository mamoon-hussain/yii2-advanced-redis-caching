<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "localized_place_contents".
 *
 * @property int $id
 * @property string $lang
 * @property int $item_id
 * @property string|null $content
 *
 * @property PlaceContents $item
 */
class LocalizedPlaceContents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localized_place_contents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang', 'item_id'], 'required'],
            [['item_id'], 'integer'],
            [['content'], 'string'],
            [['lang'], 'string', 'max' => 512],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlaceContents::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('all', 'ID'),
            'lang' => Yii::t('all', 'Lang'),
            'item_id' => Yii::t('all', 'Item ID'),
            'content' => Yii::t('all', 'Content'),
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(PlaceContents::className(), ['id' => 'item_id']);
    }
}
