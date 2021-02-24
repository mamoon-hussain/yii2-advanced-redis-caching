<?php

namespace common\models;

use common\enums\Constents;
use common\models\Product;
use Yii;


class Category extends \common\models\generated\Category
{
    public $imagesFile;
    const image_directory = 'category_images';


    public function rules()
    {
        $p = parent::rules();
//        $p[] = [['imagesFile'], 'file','extensions' => 'jpg, png, jpeg, gif', 'on'=>'update'];
        $p[] = [['imagesFile'], 'safe'];

        return $p;
    }

    public function afterFind()
    {
        //language
        $localizationModel = LocalizedCategory::find()
            ->andWhere(['lang' => api_lang()])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $this->name = $localizationModel->name;
        }
        //

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //save language
        $localizationModel = LocalizedCategory::find()
            ->andWhere(['lang' => Yii::$app->language])
            ->andWhere(['item_id' => $this->id])
            ->one();
        if(!$localizationModel){
            $localizationModel = new LocalizedCategory();
            $localizationModel->item_id = $this->id;
            $localizationModel->lang = Yii::$app->language;
        }

        $localizationModel->name = $this->name;
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
        $p['type'] = t("Type");
        $p['image'] = t("Image");
        $p['name'] = t( "Name");
        $p['description'] = t( "Description");
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

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }


}
