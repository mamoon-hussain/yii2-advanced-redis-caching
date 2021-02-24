<?php
/**
 * Error handler version for web based modules
 */

namespace common\modules\errorhandler;

use common\modules\errorhandler\ErrorHandlerTrait;

/**
 * ErrorHandler
 * @package bedezign\yii2\audit\components\web
 */
class ErrorHandler extends \yii\web\ErrorHandler
{
    use ErrorHandlerTrait;

}