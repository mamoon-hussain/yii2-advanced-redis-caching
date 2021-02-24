<?php

namespace common\models\generated;

use common\models\User;
use Yii;

/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $product_id
 * @property int|null $place_id
 * @property int $status
 * @property string $created_date
 * @property string|null $fname
 * @property string|null $lname
 * @property string|null $phone
 * @property string|null $email
 * @property int $enums
 * @property int $type
 * @property int|null $class_period
 * @property string|null $start_date
 * @property int|null $price_unit_number
 * @property int|null $payment_method
 * @property string|null $payment_data
 * @property float|null $price
 * @property string|null $payment_result
 *
 * @property Place $place
 * @property Product $product
 * @property RequestDates[] $requestDates
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'created_date', 'enums', 'type'], 'required'],
            [['user_id', 'product_id', 'place_id', 'status', 'enums', 'type', 'class_period', 'price_unit_number', 'payment_method'], 'integer'],
            [['created_date', 'start_date'], 'safe'],
            [['payment_data'], 'string'],
            [['price'], 'number'],
            [['fname', 'lname', 'phone', 'email', 'payment_result'], 'string', 'max' => 512],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::className(), 'targetAttribute' => ['place_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'place_id' => 'Place ID',
            'status' => 'Status',
            'created_date' => 'Created Date',
            'fname' => 'Fname',
            'lname' => 'Lname',
            'phone' => 'Phone',
            'email' => 'Email',
            'enums' => 'Enums',
            'type' => 'Type',
            'class_period' => 'Class Period',
            'start_date' => 'Start Date',
            'price_unit_number' => 'Price Unit Number',
            'payment_method' => 'Payment Method',
            'payment_data' => 'Payment Data',
            'price' => 'Price',
            'payment_result' => 'Payment Result',
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

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[RequestDates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestDates()
    {
        return $this->hasMany(RequestDates::className(), ['request_id' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
