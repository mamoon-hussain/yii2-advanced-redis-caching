<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "localized_app_info".
 *
 * @property int $id
 * @property string $lang
 * @property int $item_id
 * @property string|null $description
 * @property string|null $home_description
 *
 * @property AppInfo $item
 */
class LocalizedAppInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localized_app_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang', 'item_id'], 'required'],
            [['item_id'], 'integer'],
            [['description', 'home_description'], 'string'],
            [['lang'], 'string', 'max' => 512],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => AppInfo::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'description' => Yii::t('all', 'Description'),
            'home_description' => Yii::t('all', 'Home Description'),
        ];
    }

    /**
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(AppInfo::className(), ['id' => 'item_id']);
    }
}
