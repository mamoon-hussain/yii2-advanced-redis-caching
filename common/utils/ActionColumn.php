<?php

namespace common\utils;

use Yii;
use yii\helpers\Html;

class ActionColumn extends \yii\grid\ActionColumn {

    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye');
        $this->initDefaultButton('update', 'pencil');
        $this->initDefaultButton('delete', 'trash', [
            'data-confirm' => t('Are you sure you want to delete this item?'),
            'data-method' => 'post',
        ]);
    }

    protected function initDefaultButton($name, $iconName, $additionalOptions = [])
    {
        if (!isset($this->buttons[$name]) && strpos($this->template, '{' . $name . '}') !== false) {
            $this->buttons[$name] = function ($url, $model, $key) use ($name, $iconName, $additionalOptions) {
                switch ($name) {
                    case 'view':
                        $title = Yii::t('yii', 'View');
                        break;
                    case 'update':
                        $title = Yii::t('yii', 'Update');
                        break;
                    case 'delete':
                        $title = Yii::t('yii', 'Delete');
                        break;
                    default:
                        $title = ucfirst($name);
                }
                $options = array_merge([
                    'title' => $title,
                    'aria-label' => $title,
                    'data-pjax' => '0',
                ], $additionalOptions, $this->buttonOptions);
//                $icon = Html::tag('span', '', ['class' => "glyphicon glyphicon-$iconName"]);
                $icon = Html::tag('span', '', ['class' => "fa fa-$iconName", 'style' => '    margin: 0 2%']);
                return Html::a($icon, $url, $options);
            };
        }
    }

}
