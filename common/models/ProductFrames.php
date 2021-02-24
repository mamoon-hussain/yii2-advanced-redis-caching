<?php

namespace common\models;

use common\enums\Constents;
use Yii;


class ProductFrames extends generated\ProductFrames
{
    public $imagesFile;
    const image_directory = 'product_images';


    public function rules()
    {
        $p = parent::rules();
//        $p[] = [['imagesFile'], 'file','extensions' => 'jpg, png, jpeg, gif', 'on'=>'update'];
        $p[] = [['imagesFile'], 'safe'];

        return $p;
    }

    public function attributeLabels()
    {
        $p = parent::attributeLabels();
        $p['id'] = t("ID");
        $p['image'] = t("Image");
        $p['imagesFile'] = t("Images");
        $p['product_id'] = t("Product ID");
        $p['name'] = t("Name");

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


}
