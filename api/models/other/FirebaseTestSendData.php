<?php

/**
 * @license Apache 2.0
 */

namespace api\models\other;

use api\models\other\Category;
use api\models\other\Region;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class FirebaseTestSendData
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="FirebaseTestSendData model",
 *     description="FirebaseTestSendData model",
 * )
 */
class FirebaseTestSendData extends Model
{
    /**
     * @OA\Property(
     *     description="Data item key",
     *     title="key",
     * )
     *
     * @var string
     */
    public $key;

    /**
     * @OA\Property(
     *     description="Data item value",
     *     title="value",
     * )
     *
     * @var string
     */
    public $value;


}

