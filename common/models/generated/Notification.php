<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "notification".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $create_date
 * @property string|null $sent_date
 * @property string|null $topec_name
 * @property int|null $status
 * @property int|null $user_id
 * @property int|null $data_id
 * @property int|null $type
 * @property int|null $is_read
 * @property int|null $publish
 */
class Notification extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body', 'create_date'], 'required'],
            [['body'], 'string'],
            [['create_date', 'sent_date'], 'safe'],
            [['status', 'user_id', 'data_id', 'type', 'is_read', 'publish'], 'integer'],
            [['title', 'topec_name'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('all', 'ID'),
            'title' => Yii::t('all', 'Title'),
            'body' => Yii::t('all', 'Body'),
            'create_date' => Yii::t('all', 'Create Date'),
            'sent_date' => Yii::t('all', 'Sent Date'),
            'topec_name' => Yii::t('all', 'Topec Name'),
            'status' => Yii::t('all', 'Status'),
            'user_id' => Yii::t('all', 'User ID'),
            'data_id' => Yii::t('all', 'Data ID'),
            'type' => Yii::t('all', 'Type'),
            'is_read' => Yii::t('all', 'Is Read'),
            'publish' => Yii::t('all', 'Publish'),
        ];
    }
}
