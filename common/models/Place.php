<?php

namespace common\models;
use common\enums\Constents;
use common\enums\RequestEnums;
use common\enums\RequestStatus;
use common\models\PlaceImage;
use Yii;


class Place extends generated\Place
{
    public $imagesFile;
    public $videoFile;
    const image_directory = 'place_images';
    public $date_range;


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
        if($this->start_date) {
            $this->date_range = $this->start_date;
        }
        //language
        $localizationModel = LocalizedPlace::find()
            ->andWhere(['lang' => api_lang()])
            ->andWhere(['item_id' => $this->id])
            ->one();

        if($localizationModel){
            $this->name = $localizationModel->name;
            $this->small_description = $localizationModel->small_description;
            $this->description = $localizationModel->description;
        }
        //

        parent::afterFind();
    }

    public function afterSave($insert, $changedAttributes)
    {
        //save language
        $localizationModel = LocalizedPlace::find()
            ->andWhere(['lang' => Yii::$app->language])
            ->andWhere(['item_id' => $this->id])
            ->one();
        if(!$localizationModel){
            $localizationModel = new LocalizedPlace();
            $localizationModel->item_id = $this->id;
            $localizationModel->lang = Yii::$app->language;
        }

        $localizationModel->name = $this->name;
        $localizationModel->small_description = $this->small_description;
        $localizationModel->description = $this->description;
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
        $p['image'] = t("Image");
        $p['name'] = t( "Name");
        $p['status'] = t("Status");
        $p['course_type'] = t("Course Type");
        $p['type'] = t("Type");
        $p['description'] = t( "Description");
        $p['small_description'] = t( "Small Description");
        $p['capacity'] = t( "Capacity");
        $p['create_date'] = t("Create Date");
        $p['duration'] = t("Duration");
        $p['oneday_price'] = t("Oneday Price");
        $p['seats_number'] = t("Seats Number");
        $p['start_date'] = t("Start Date");
        $p['end_date'] = t("End Date");
        $p['oneday_price'] = t("One Day Price");
        $p['date_range'] = t("Date Range");
        $p['price_unit_number'] = t("Days #");
        $p['videoFile'] = t("Video");
        $p['video'] = t("Video");
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

    public function saveContents($contents = [])
    {
        $allContents = $this->placeContents;
        $toBeRemovedContents = [];
        $ids = [];

        foreach ($contents as $oneContent){
            if(!$oneContent['content']){
                continue;
            }
            $dbContent = null;
            if(isset($oneContent['id'])){
                $ids[] = $oneContent['id'];
                $dbContent = PlaceContents::findOne($oneContent['id']);
            }
            if(!$dbContent){
                $dbContent = new PlaceContents();
            }
            $dbContent->place_id=$this->id;
            $dbContent->content = $oneContent['content'];

            if(!$dbContent->save())
            {
                stopv($dbContent->errors);
            }
        }

        foreach ($allContents as $one){
            if(!in_array($one->id, $ids)){
                $toBeRemovedContents[]=$one->id;
            }
        }
        foreach ($toBeRemovedContents as $one){
            $ContentOne = PlaceContents::findOne($one);
            if($ContentOne){
                $ContentOne->delete();
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

    public function getPlaceContents()
    {
        return $this->hasMany(PlaceContents::className(), ['place_id' => 'id']);
    }

    public function getRequestsNumber()
    {
        $requestNumber = Request::find()
            ->andWhere(['place_id' => $this->id])
            ->andWhere(['or',
                ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
                ['payment_result' => 'CAPTURED']
//                ['and', ['payment_method' => PaymentMethod::paypal], ['not', ['or', ['payment_data' => null], ['payment_data' => '']]]]
            ])
            ->count();

        return $requestNumber;
    }

    public function getIsRequested()
    {
        if(userId()){
            $requestNumber = Request::find()
                ->andWhere(['place_id' => $this->id])
                ->andWhere(['user_id' => userId()])
                ->andWhere(['not',  ['in', 'status', [RequestStatus::rejected]]])
                ->one();
            if($requestNumber){
                return true;
            }
        }

        return false;
    }

    public function getNamePrice()
    {
        return $this->name . ' ('.$this->price.' '.t('KD').' '.t('/Day').')';
    }

    public function getIsBooked()
    {
        $requested = Request::find()
            ->andWhere(['place_id' => $this->id])
            ->andWhere(['or',
                ['in', 'status', [RequestStatus::under_process, RequestStatus::done]],
                ['payment_result' => 'CAPTURED']
            ])
            ->orderBy('id desc')
            ->one();
        if($requested){
           return $requested;
        }
        return false;
    }

    public function getNamePriceAvailableDate()
    {
        $availability = t('Available');
        $requested = $this->isBooked;
        if($requested){
            $availability = t('Not Available') . t(', will be available again on: ')
                .date(Constents::date_format_view_3, strtotime($requested->start_date. ' + '.($requested->price_unit_number+1).' days'));
        }
//        return $this->name . ' ('.$this->price.' '.t('KD').' '.t('/Day').') '.$availability;
        return $this->name .' - '.$availability;
    }

    public function getPlaceImages()
    {
        return $this->hasMany(PlaceImage::className(), ['place_id' => 'id']);
    }

    public  function savePlaceImages($ids = [])
    {
        $allImages = $this->placeImages;

        $toBeRemoved = [];
        foreach ($allImages as $one){
            if(!in_array($one->id, $ids)){
                $toBeRemoved[]=$one->id;
            }
        }
        foreach ($toBeRemoved as $one){
            $imageOne = PlaceImage::findOne($one);
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
                $previewImage = new PlaceImage();
                $previewImage->place_id=$this->id;
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





}
