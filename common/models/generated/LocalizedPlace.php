<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "localized_place".
 *
 * @property int $id
 * @property string $lang
 * @property int $item_id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $small_description
 *
 * @property Place $item
 */
class LocalizedPlace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localized_place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang', 'item_id'], 'required'],
            [['item_id'], 'integer'],
            [['description'], 'string'],
            [['lang', 'name', 'small_description'], 'string', 'max' => 512],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'name' => Yii::t('all', 'Name'),
            'description' => Yii::t('all', 'Description'),
            'small_description' => Yii::t('all', 'Small Description'),
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Place::className(), ['id' => 'item_id']);
    }
}
