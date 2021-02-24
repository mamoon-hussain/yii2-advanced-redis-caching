<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "common_question".
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $create_date
 * @property int $status
 */
class CommonQuestion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'common_question';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question', 'answer', 'create_date', 'status'], 'required'],
            [['question', 'answer'], 'string'],
            [['create_date'], 'safe'],
            [['status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'create_date' => 'Create Date',
            'status' => 'Status',
        ];
    }
}
