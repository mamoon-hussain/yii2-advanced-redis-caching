<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "localized_category".
 *
 * @property int $id
 * @property string $lang
 * @property int $item_id
 * @property string|null $name
 *
 * @property Category $item
 */
class LocalizedCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localized_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang', 'item_id'], 'required'],
            [['item_id'], 'integer'],
            [['lang', 'name'], 'string', 'max' => 512],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['item_id' => 'id']],
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
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Category::className(), ['id' => 'item_id']);
    }
}
