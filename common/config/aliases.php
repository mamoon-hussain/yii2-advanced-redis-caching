<?php

return [
    'aliases' => [
        //user manage
        '@webvimark/modules/UserManagement' => '@common/modules/user-manage/webvimark/module-user-management',
        '@webvimark/image' => '@common/modules/user-manage/webvimark/image',
        '@webvimark/helpers' => '@common/modules/user-manage/webvimark/helpers',
        '@webvimark/extensions/GridPageSize' => '@common/modules/user-manage/webvimark/grid-page-size',
        '@webvimark/extensions/GridBulkActions' => '@common/modules/user-manage/webvimark/grid-bulk-actions',
        '@webvimark/extensions/DateRangePicker' => '@common/modules/user-manage/webvimark/date-range-picker',
        '@webvimark/extensions/BootstrapSwitch' => '@common/modules/user-manage/webvimark/bootstrap-switch',
        '@webvimark/components' => '@common/modules/user-manage/webvimark/components',
        //
        //error handler
        '@bedezign/yii2/audit' => '@common/modules/bedezign/yii2-audit/src',
        //
        //swagger
        '@yii2mod/swagger' => '@common/modules/yii2-swagger',
        //
        //
        '@bower/jquery/dist' => '@vendor/bower-asset/jquery/dist',
        '@bower/bootstrap/dist' => '@vendor/bower-asset/bootstrap/dist',
        '@bower/swagger-ui/dist' => '@common/modules/bower-asset/swagger-ui/dist',
        '@bower/bootstrap-datepicker/dist' => '@vendor/bower-asset/bootstrap-datepicker/dist',
        '@bower/yii2-pjax' => '@vendor/bower-asset/yii2-pjax',
        '@bower/jquery-timeago' => '@vendor/bower-asset/jquery-timeago',
        '@bower/x-editable/dist/bootstrap3-editable' => '@common/modules/bower-asset/x-editable/dist/bootstrap3-editable',
        '@bower/intl-tel-input' => '@common/modules/bower-asset/intl-tel-input',

        '@kartik/file' => '@common/modules/kartik-v/yii2-widget-fileinput/src',
        '@kartik/plugins/fileinput' => '@common/modules/kartik-v/bootstrap-fileinput',
        '@kartik/daterange' => '@common/modules/kartik-v/yii2-date-range/src',
        '@kartik/datepicker' => '@common/modules/kartik-v/yii2-date-picker/src',
        '@kartik/date' => '@common/modules/kartik-v/yii2-date-picker/src',

        '@yii2mod/moderation' => '@common/modules/yii2mod/yii2-moderation',
        '@yii2mod/enum' => '@common/modules/yii2mod/yii2-enum',
        '@yii2mod/editable' => '@common/modules/yii2mod/yii2-editable',
        '@yii2mod/comments' => '@common/modules/yii2mod/yii2-comments',
        '@yii2mod/behaviors' => '@common/modules/yii2mod/yii2-behaviors',

        '@paulzi/adjacencyList' => '@common/modules/yii2-adjacency',

        //backjob
        '@backjob' => '@common/modules/backjob',
        //

        //spinner field
        '@kartik/touchspin' => '@common/modules/yii2-widget-touchspin-master/src',
        //

        //cropper
        '@bilginnet/cropper' => '@common/modules/yii2-cropper/src',
        //

        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',

    ],
];
