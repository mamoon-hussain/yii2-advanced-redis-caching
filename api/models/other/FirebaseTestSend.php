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
 * Class FirebaseTestSend
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="FirebaseTestSend model",
 *     description="FirebaseTestSend model",
 * )
 */
class FirebaseTestSend extends Model
{
    /**
     * @OA\Property(
     *     description="Your device token",
     *     title="device_token",
     * )
     *
     * @var string
     */
    public $device_token;

    /**
     * @OA\Property(
     *     description="Notification title",
     *     title="title",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     description="Notification body",
     *     title="body",
     * )
     *
     * @var string
     */
    public $body;

    /**
     * @OA\Property(
     *     description="Data array (key: value)",
     *     title="data",
     *     @OA\Items(ref="#/components/schemas/FirebaseTestSendData")
     * )
     *
     * @var array
     */
    public $data;

}

