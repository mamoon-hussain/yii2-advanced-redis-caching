<?php


namespace common\widgets;


use yii\widgets\Breadcrumbs;

class BaseBreadcrumbs extends Breadcrumbs
{
    public $tag = 'ol';
    public $itemTemplate = '<li class="breadcrumb-item">{link}</li>';
    public $activeItemTemplate ='<li class="breadcrumb-item active">{link}</li>';
}