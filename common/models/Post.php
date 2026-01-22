<?php

namespace common\models;
use Yii;

use common\enums\Constents;

class Post extends generated\Post
{
    public $imagesFile;
    const image_directory = 'post_images';


    public function rules()
    {
        $p = parent::rules();

        $p[] = [['imagesFile'], 'safe'];

        return $p;
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['id'] = t("ID");
        $p['imagesFile'] = t("Image");
        $p['type'] = t("Type");
        $p['image'] = t("Image");
        $p['video'] = t("Video");
        $p['name'] = t( "Name");
        $p['author_id'] = t( 'Author');
        $p['category_id'] = t( 'Category');

        $p['status'] = t("Status");
        $p['create_date'] = t("Create Date");
//
        return $p;
    }

    public function uploadImage()
    {

        if(!in_array($this->imagesFile->extension, Constents::image_extentions)){
            $this->addError('imagesFile', \Yii::t('all', "Only the following extensions are allowed: ").implode(', ', Constents::image_extentions));
            return false;
        }
        $dir = Yii::getAlias('@backend') . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . self::image_directory . DIRECTORY_SEPARATOR;
        $this->image = uniqid() . '.' . $this->imagesFile->extension;
        $org_image = $dir . $this->image;
        $this->imagesFile->saveAs($org_image);

        return true;
    }

    public function getImageUrl()
    {
        if (!$this->image) {
            return imageURL('placeholder.jpg');
        }
        return imageURL( self::image_directory . "/" . $this->image);
    }
}
