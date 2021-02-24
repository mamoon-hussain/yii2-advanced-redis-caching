<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property int $id
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property int $status
 * @property string $create_date
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'create_date'], 'required'],
            [['status'], 'integer'],
            [['create_date'], 'safe'],
            [['name', 'email', 'phone'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
            'create_date' => 'Create Date',
        ];
    }
}
