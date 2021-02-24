<?php

namespace common\models;

use common\enums\Constents;
use common\models\Category;
use common\models\ProductFrames;
use common\models\Request;
use Yii;
use yii\web\UploadedFile;


class Product extends generated\Product
{
    public $imagesFile;
    public $videoFile;
    const image_directory = 'product_images';
    public $ispaid;


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
        $localizationModel = LocalizedProduct::find()
            ->andWhere(['lang' => api_lang()])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $this->name = $localizationModel->name;
            $this->description = $localizationModel->description;
            $this->small_description = $localizationModel->small_description;
        }
        //

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //save language
        $localizationModel = LocalizedProduct::find()
            ->andWhere(['lang' => Yii::$app->language])
            ->andWhere(['item_id' => $this->id])
            ->one();
        if(!$localizationModel){
            $localizationModel = new LocalizedProduct();
            $localizationModel->item_id = $this->id;
            $localizationModel->lang = Yii::$app->language;
        }

        $localizationModel->name = $this->name;
        $localizationModel->description = $this->description;
        $localizationModel->small_description = $this->small_description;
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
        $p['imagesFile'] = t("Image");
        $p['price'] = t("Price");
        $p['type'] = t("Type");
        $p['image'] = t("Image");
        $p['name'] = t( "Name");
        $p['description'] = t( "Description");
        $p['status'] = t("Status");
        $p['create_date'] = t("Create Date");
        $p['category_id'] = t("Category");
        $p['videoFile'] = t("Video");
        $p['video'] = t("Video");
        $p['has_offer'] = t("Has Offer?");
        $p['old_price'] = t("Old Price");
        $p['small_description'] = t("Small Description");
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

    public function getImageUrl()
    {
        if (!$this->image) {
            return imageURL('placeholder.jpg');
        }
        return imageURL( self::image_directory . "/" . $this->image);
    }

    public function getVideoUrl()
    {
        if (!$this->video) {
            return $this->video;
        }
        return imageURL( self::image_directory . "/" . $this->video);
    }

    public  function saveProductImages($ids = [])
    {
        $allImages = $this->productFrames;

        $toBeRemoved = [];
        foreach ($allImages as $one){
            if(!in_array($one->id, $ids)){
                $toBeRemoved[]=$one->id;
            }
        }
        foreach ($toBeRemoved as $one){
            $imageOne = ProductFrames::findOne($one);
            if($imageOne){
                $imageOne->delete();
            }
        }

//        $previewImages = UploadedFile::getInstancesByName('imagesFile');
        $post = Yii::$app->request->post();
        if(isset($post['imagesFile'])){
            $previewImages = $post['imagesFile'];
        } else {
            $previewImages = [];
        }

        foreach ($previewImages as $onePreviewImage){
            if($onePreviewImage){
                $previewImage = new ProductFrames();
                $previewImage->product_id=$this->id;
                $previewImage->name=$this->name;
                $previewImage->imagesFile = $onePreviewImage;
                $previewImage->image = 'temp';
//            $previewImage->uploadImage('image','imagesFile');

                if(!$previewImage->save())
                {
                    stopv($previewImage->errors);
                }
            }
        }
        return true;
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

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getProductFrames()
    {
        return $this->hasMany(ProductFrames::className(), ['product_id' => 'id']);
    }

    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['product_id' => 'id']);
    }
}
