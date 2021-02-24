<?php

namespace common\models;
use common\enums\Constents;
use Yii;


class AppInfo extends generated\AppInfo
{
    public $videoFile;
    public $imagesFile;
    const image_directory = 'app_info';

    public function rules()
    {
        $p = parent::rules();
//        $p[] = [['imagesFile'], 'file','extensions' => 'jpg, png, jpeg, gif', 'on'=>'update'];
        $p[] = [['videoFile'], 'file'];
        $p[] = [['imagesFile'], 'safe'];

        return $p;
    }

    public function afterFind()
    {
        //language
        $localizationModel = LocalizedAppInfo::find()
            ->andWhere(['lang' => api_lang()])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $this->description = $localizationModel->description;
            $this->home_description = $localizationModel->home_description;
        }
        //

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //save language
        $localizationModel = LocalizedAppInfo::find()
            ->andWhere(['lang' => Yii::$app->language])
            ->andWhere(['item_id' => $this->id])
            ->one();
        if(!$localizationModel){
            $localizationModel = new LocalizedAppInfo();
            $localizationModel->item_id = $this->id;
            $localizationModel->lang = Yii::$app->language;
        }

        $localizationModel->description = $this->description;
        $localizationModel->home_description = $this->home_description;
        if(!$localizationModel->save()){
            stopv($localizationModel->errors);
        }
        //
        parent::afterSave($insert, $changedAttributes);
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['id'] = t("ID");
        $p['videoFile'] = t("Video");
        $p['video'] = t("Video");

        return $p;
    }

    public function uploadVideo()
    {
        if(!in_array($this->videoFile->extension, Constents::video_extentions)){
            $this->addError('videoFile', \Yii::t('all', "Only the following extensions are allowed: ").implode(', ', Constents::video_extentions));
            return false;
        }
        $dir = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . self::image_directory . DIRECTORY_SEPARATOR;
        $this->video = uniqid() . '.' . $this->videoFile->extension;
        $org_image = $dir . $this->video;
        $this->videoFile->saveAs($org_image);

        return true;
    }

    public function getVideoUrl()
    {
        if (!$this->video) {
            return $this->video;
        }
        return imageURL( self::image_directory . "/" . $this->video);
    }

    public function beforeSave($insert)
    {
        //save crop
        if (is_string($this->imagesFile) && strstr($this->imagesFile, 'data:image')) {
            // creating image file as png
            $data = $this->imagesFile;

            $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data));
            $fileName = time() . '-' . rand(100000, 999999) . '.png';
            $dir = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . self::image_directory . DIRECTORY_SEPARATOR;
            file_put_contents($dir . $fileName, $data);


            // deleting old image
            // $this->image is real attribute for filename in table
            // customize your code for your attribute
//            if (!$this->isNewRecord && !empty($this->image)) {
//                unlink(Yii::getAlias('@uploadPath/'.$this->image));
//            }

            // set new filename
            $this->image = $fileName;
        }

        return parent::beforeSave($insert);
    }

    public function getImageUrl()
    {
        if (!$this->image) {
            return imageURL('logo.png');
        }
        return imageURL( self::image_directory . "/" . $this->image);
    }

}
