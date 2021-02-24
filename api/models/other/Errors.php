<?php

/**
 * @license Apache 2.0
 */

namespace api\models\other;

use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Class Errors
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="Errors model",
 *     description="Errors model",
 * )
 */
class Errors extends Model
{
    /**
     * @OA\Property(
     *     description="English Error",
     *     title="en",
     * )
     *
     * @var string
     */
    public $en;

    /**
     * @OA\Property(
     *     description="Arabic Error",
     *     title="ar",
     * )
     *
     * @var string
     */
    public $ar;

}

