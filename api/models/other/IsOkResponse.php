<?php

/**
 * @license Apache 2.0
 */

namespace api\models\other;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class IsOkResponse
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="IsOkResponse model",
 *     description="IsOkResponse model",
 * )
 */
class IsOkResponse extends Model
{
    /**
     * @OA\Property(
     *     description="English text",
     *     title="en",
     * )
     *
     * @var string
     */
    public $en;

    /**
     * @OA\Property(
     *     description="Arabic text",
     *     title="ar",
     * )
     *
     * @var string
     */
    public $ar;

}

