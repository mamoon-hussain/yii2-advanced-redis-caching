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
 * Class ItemRequest
 *
 * @package Petstore30
 *
 * @OA\Schema(
 *     title="ItemRequest model",
 *     description="ItemRequest model",
 * )
 */
class ItemRequest extends Model
{
    /**
     * @OA\Property(
     *     description="item ID",
     *     title="id",
     * )
     *
     * @var string
     */
    public $id;



}

