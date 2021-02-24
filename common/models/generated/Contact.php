<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $email
 * @property string|null $symbol
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'string', 'max' => 512],
            [['symbol'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'symbol' => 'Symbol',
        ];
    }
}
