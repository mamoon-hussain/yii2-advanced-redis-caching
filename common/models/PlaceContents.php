<?php

namespace common\models;

use Yii;


class PlaceContents extends generated\PlaceContents
{
    public function afterFind()
    {
        //language
        $localizationModel = LocalizedPlaceContents::find()
            ->andWhere(['lang' => api_lang()])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $this->content = $localizationModel->content;
        }
        //

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //save language
        $localizationModel = LocalizedPlaceContents::find()
            ->andWhere(['lang' => Yii::$app->language])
            ->andWhere(['item_id' => $this->id])
            ->one();
        if(!$localizationModel){
            $localizationModel = new LocalizedPlaceContents();
            $localizationModel->item_id = $this->id;
            $localizationModel->lang = Yii::$app->language;
        }

        $localizationModel->content = $this->content;
        if(!$localizationModel->save()){
            stopv($localizationModel->errors);
        }
        //
        parent::afterSave($insert, $changedAttributes);
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['content'] = t('Content');
        return $p;
    }

    public function getDescription($lang = '')
    {
        $description = '';
        if(!$lang){
            $lang = Yii::$app->language;
            $description = $this->content;
        }
        //language
        $localizationModel = LocalizedPlaceContents::find()
            ->andWhere(['lang' => $lang])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $description = $localizationModel->content;
        }
        return $description;
        //
    }
}
