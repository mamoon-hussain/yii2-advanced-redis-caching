<?php

namespace common\models;

use Yii;


class CommonQuestion extends generated\CommonQuestion
{
    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['question'] = t("Question");
        $p['answer'] = t("Answer");
        $p['create_date'] = t("Create Date");
        $p['status'] = t("Status");
        return $p;
    }
}