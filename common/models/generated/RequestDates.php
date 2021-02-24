<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "request_dates".
 *
 * @property int $id
 * @property int $request_id
 * @property string $date
 * @property int|null $period
 *
 * @property Request $request
 */
class RequestDates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_dates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['request_id', 'date'], 'required'],
            [['request_id', 'period'], 'integer'],
            [['date'], 'safe'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Request::className(), 'targetAttribute' => ['request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'request_id' => 'Request ID',
            'date' => 'Date',
            'period' => 'Period',
        ];
    }

    /**
     * Gets query for [[Request]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Request::className(), ['id' => 'request_id']);
    }
}
