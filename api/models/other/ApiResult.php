<?php

/**
 * @license Apache 2.0
 */

namespace api\models\other;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class ApiResult
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ApiResult model",
 *     description="ApiResult model",
 * )
 */
class ApiResult extends Model
{
    /**
     * @OA\Property(
     *     description="Indicates if the response is ok or not",
     *     title="isOk",
     * )
     *
     * @var boolean
     */
    public $isOk;

    /**
     * @OA\Property(
     *     description="Api message",
     *     title="message",
     * )
     *
     * @var ApiMessage
     */
    public $message;


}

