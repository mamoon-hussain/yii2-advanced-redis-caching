<?php

namespace common\services;

use api\models\ads\AdsListApiModel;
use api\models\ads\AdsTypeApiModel;
use api\models\ads\AdsUrlApiModel;
use api\models\app_info\AboutAppApiModel;
use api\models\auth\ApiResultProfileResult;
use api\models\auth\ApiResultRegisterResult;
use api\models\auth\ProfileResult;
use api\models\auth\RegisterResult;
use api\models\comment\CommentApiModel;
use api\models\comment\TopicCommentApiModel;
use api\models\comment\TopicsCommentApiModel;
use api\models\complaint\ReportReasonApiModel;
use api\models\document\DocumentApiModel;
use api\models\document\GeneralDocumentApiModel;
use api\models\document\TopicDocumentApiModel;
use api\models\document\TypeApiModel;
use api\models\document\UniversityDocumentApiModel;
use api\models\feedback\FeedbackFormApi;
use api\models\inventory\CustomerApiModel;
use api\models\inventory\DeliveryApiModel;
use api\models\inventory\ImagesApiModel;
use api\models\inventory\InventoryApiModel;
use api\models\inventory\InventoryDetailsApiModel;
use api\models\inventory\PersonalItemsApiModel;
use api\models\inventory\TitleApiModel;
use api\models\inventory\VideoItemsApiModel;
use api\models\lists\CategoryApiModel;
use api\models\lists\CategoryDetailsApiModel;
use api\models\lists\ColorApiModel;
use api\models\lists\FaqApiModel;
use api\models\lists\FullCategoryApiModel;
use api\models\lists\IdValueApiModel;
use api\models\lists\PhoneGuideApiModel;
use api\models\lists\PhoneListApiModel;
use api\models\lists\ProfessionApiModel;
use api\models\lists\SpecialtyApiModel;
use api\models\lists\StoreApiModel;
use api\models\lists\SubCategoryApiModel;
use api\models\lists\TitleStateApiModel;
use api\models\lists\TransportationCompanyApiModel;
use api\models\lists\UniversityApiModel;
use api\models\lists\UsefulAppsApiModel;
use api\models\lists\UsefulFacebookLinksApiModel;
use api\models\lists\UsefulLinksApiModel;
use api\models\lists\UsefulSitesApiModel;
use api\models\location\Area;
use api\models\location\AreaApiModel;
use api\models\location\City;
use api\models\location\CityApiModel;
use api\models\location\CityDetailsApiModel;
use api\models\location\CountryDetailsApiModel;
use api\models\location\Location;
use api\models\location\LocationApiModel;
use api\models\location\MapLocationApiModel;
use api\models\location\State;
use api\models\location\StateApiModel;
use api\models\location\StateDetailsApiModel;
use api\models\order\AddressRequest;
use api\models\order\OrderDetailsApiModel;
use api\models\order\OrderListApiModel;
use api\models\order\OrderProductApiModel;
use api\models\order\ProductApiModel;
use api\models\other\ApiMessage;
use api\models\paths\PathApiModel;
use api\models\paths\PathDetailsApiModel;
use api\models\place\ImageApiModel;
use api\models\place\OpenDayApiModel;
use api\models\place\PhoneApiModel;
use api\models\place\PlaceApiModel;
use api\models\place\PlaceDetailsApiModel;
use api\models\place\ServiceApiModel;
use api\models\quiz\QuizAnswerApiModel;
use api\models\quiz\QuizDetailsApiModel;
use api\models\quiz\QuizQuestionApiModel;
use api\models\quiz\QuizScoreApiModel;
use api\models\quiz\UserQuizApiModel;
use api\models\subject\GeneralTopicDetailsApiModel;
use api\models\subject\ItemUserApiModel;
use api\models\subject\ReviewApiModel;
use api\models\subject\SubjectDetailsApiModel;
use api\models\subject\SubjectRateDetailsApiModel;
use api\models\subject\SubjectReferencesApiModel;
use api\models\subject\SubjectRequirementsApiModel;
use api\models\subject\SubjectsListApiModel;
use api\models\subject\SubjectSubCategoryApiModel;
use api\models\subject\SubjectToolsApiModel;
use api\models\subject\SubjectTopicDetailsApiModel;
use api\models\subject\TopicDetailsApiModel;
use api\models\subject\TopicsListApiModel;
use api\models\subject\TopicsTitlesApiModel;
use api\models\teacher\TeacherDetailsApiModel;
use api\models\teacher\TeacherListApiModel;
use api\models\ticket\TicketAnswerApiModel;
use api\models\ticket\TicketApiModel;
use api\models\ticket\TicketDetailsApiModel;
use api\models\ticket\TicketStatusApiModel;
use api\models\ticket\TicketTitleApiModel;
use api\models\ticket\TicketTypeApiModel;
use api\models\university\UniversityDetailsApiModel;
use common\enums\ActiveInactiveStatus;
use common\enums\AdsType;
use common\enums\Constents;
use common\enums\ErrorCode;
use common\enums\InventoryDeliveryEnum;
use common\enums\InventoryImageTypeEnum;
use common\enums\InventoryStatus;
use common\enums\InventoryTitle;
use common\enums\InventoryType;
use common\enums\LinkEnum;
use common\enums\MaxSizeEnum;
use common\enums\OrderStatus;
use common\enums\OrderType;
use common\enums\PaymentMethod;
use common\enums\QuestionTypeStatus;
use common\enums\SubjectDependancyType;
use common\enums\TicketStatusEnum;
use common\enums\TitleReceiveWay;
use common\enums\TopicStatus;
use common\enums\UserGenderEnum;
use common\enums\WeekDays;
use common\enums\YesNoEnum;
use common\models\InventoryImage;
use common\models\Supermarket;
use common\models\TransportationCompany;
use common\models\UserVideo;
use yii2mod\moderation\enums\Status;

class FillApiModelService
{
    public static function FillProfileResultModel($item)
    {
        $lang = api_lang();
        $name_attr = $lang . '_name';

        $profile = new ProfileResult([
            'id' => $item->id,
            'first_name' => $item->fname,
            'last_name' => $item->lname,
            'phone' => $item->phone,
            'email' => $item->email,
            'image' => $item->imageUrl,
            'address' => $item->address ? $item->address : '',
            'birthDate' => $item->birth_date ? date(Constents::date_format_view, strtotime($item->birth_date)) : null,
            'delivery_address' => $item->deliveryAddress ? FillApiModelService::FillAddressRequest($item->deliveryAddress) : null,
            'billing_address' => $item->billingAddress ? FillApiModelService::FillAddressRequest($item->billingAddress) : null,
        ]);

        return $profile;
    }

    public static function FillApiResultRegisterResultModel($item, $msg = '')
    {
        $lang = api_lang();
        $name_attr = $lang . '_name';

        $item->setAuthKey;

        $model = new ApiResultRegisterResult([
            'result' => new RegisterResult([
                'username' => $item->email,
                'message' => t($msg, [], $lang),
            ]),
            'isOk' => true,
            'message' => null,
        ]);;

        return $model;
    }

    public static function FillApiResultProfileResult($item)
    {

        $model = new ApiResultProfileResult([
            'result' => $item,
            'isOk' => true,
            'message' => new ApiMessage([
                'type' => 'Success',
                'code' => ErrorCode::success,
                'content' => '',
            ])
        ]);;

        return $model;
    }

    public static function FillIdValueApiModel($id, $value)
    {
        $model = new IdValueApiModel([
            'id' => ''.$id,
            'value' => $value ? $value : '',
        ]);

        return $model;
    }

    public static function FillCustomerApiModel($item)
    {
        $model = new CustomerApiModel([
            'id' => $item->id,
            'fullname' => $item->fullName,
        ]);

        return $model;
    }

    public static function FillTitleApiModel($item)
    {
        $title_scan = [];
        $title_scan_files = InventoryImage::find()
            ->andWhere(['inventory_id' => $item->id])
            ->andWhere(['type' => InventoryImageTypeEnum::title_scan])
            ->all();
        foreach ($title_scan_files as $one){
//            $title_scan[] = self::FillIdValueApiModel($one->id, $one->imageUrl);
            $title_scan[] = self::FillImagesApiModel($one);
        }
        $model = new TitleApiModel([
            'title' => self::FillIdValueApiModel($item->title, InventoryTitle::LabelOf($item->title)),
            'title_number' => $item->title_number,
            'title_state' => self::FillIdValueApiModel($item->title_state, $item->titleState ? $item->titleState->name : $item->title_state),
            'title_scan' => $title_scan,
            'title_receive_way' => self::FillIdValueApiModel($item->title_receive_way, TitleReceiveWay::LabelOf($item->title_receive_way)),
            'title_receive_date' => $item->title_receive_date ? date(Constents::date_format_view_3, strtotime($item->title_receive_date)) : '',
            'title_receive_tracking_number' => $item->title_receive_tracking_number,
        ]);

        return $model;
    }

    public static function FillImagesApiModel($item)
    {
        $model = new ImagesApiModel([
            'id' => $item->id,
            'url' => $item->imageUrl,
        ]);

        return $model;
    }

    public static function FillFullCategoryApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';
        $subLevels = [];
        foreach ($item->subLevels as $one) {
            if($one)
            {
                if($one->status == ActiveInactiveStatus::active)
                {
                    $subLevels[] = FillApiModelService::FillCategoryApiModel($one);
                }
            }

        }
        $model = new FullCategoryApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
            'image' => $item->imageUrl,
            'description' => $item->description,
            'sub_categories' => $subLevels,
        ]);
        return $model;
    }

    public static function FillCategoryApiModel($item)
    {
        $subLevels = [];
        foreach ($item->subLevels as $one)
        {
            if($one->places)
            {
                if($one->status == ActiveInactiveStatus::active)
                {
                    $subLevels[] = FillApiModelService::FillCategoryApiModel($one);
                }
            }

        }
        $model = new CategoryApiModel([
            'id' => $item->id,
            'name' => $item->name,
            'image' => $item->imageUrl,
            'description' => $item->description,
            'items_count' => (integer)$item->placesCount,
            'sub_categories' => $subLevels,

        ]);
        return $model;
    }

    public static function FillCategoryDetailsApiModel($item)
    {
        if(!$item){
            return null;
        }
        $model = new CategoryDetailsApiModel([
            'id' => $item->id,
            'name' => $item->name,
            'image' => $item->imageUrl,
            'description' => $item->description,
            'parent' => FillApiModelService::FillCategoryDetailsApiModel($item->parent),
        ]);
        return $model;
    }

    public static function FillAdsTypeApiModel($id, $name)
    {
        $model = new AdsTypeApiModel([
            'id' => $id,
            'name' => $name,
        ]);

        return $model;
    }

    public static function FillAdsListApiModel($item)
    {
        $model = new AdsListApiModel([
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'image' => $item->imageUrl,
            'url' => FillApiModelService::FillAdsUrlApiModel($item),
        ]);

        return $model;
    }

    public static function FillAdsUrlApiModel($item)
    {
        $url = '';
        $itemId = 0;
        if ($item->type != AdsType::url) {
            $itemId = $item->item_id;
        } else {
            $url = $item->url;
        }
        $model = new AdsUrlApiModel([
            'type' => $item->type,
            'typeText' => AdsType::LabelOf($item->type),
            'url' => $url,
            'itemId' => $itemId,
        ]);

        return $model;
    }

    public static function FillAboutAppApiModel($item)
    {
        $model = new AboutAppApiModel([
            'description' => $item->description,
            'email' => $item->email,
            'phone' => $item->phone,
            'mobile' => $item->mobile,
            'address' => $item->site_url,
            'facebook' => $item->facebook_url,
            'instagram' => $item->instagram_url,
            'linkedin' => $item->linkedin_url,
            'twitter' => $item->twitter_url,
        ]);

        return $model;
    }

    public static function FillStateApiModel($item)
    {
        $cities = [];
            foreach ($item->activeCities as $one) {
                $cities[] = FillApiModelService::FillCityApiModel($one);
            }
            $lang = api_lang();
            //        $name_attr = $lang.'_name';
            $name_attr = 'name';

            $model = new StateApiModel([
                'id' => $item->id,
                'name' => $item->$name_attr,
                'cities' => $cities,
            ]);
            return $model;
    }

    public static function FillStateDetailsApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';

        $model = new StateDetailsApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
        ]);
        return $model;
    }

    public static function FillCityApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';

        $model = new CityApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
        ]);
        return $model;
    }

    public static function FillCityDetailsApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';

        $model = new CityDetailsApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
            'state' => FillApiModelService::FillStateDetailsApiModel($item->state),
        ]);
        return $model;
    }

    public static function FillPlaceApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';

        $model = new PlaceApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
            'image' => $item->imageUrl,
            'category' => FillApiModelService::FillCategoryDetailsApiModel($item->category),
            'city' => FillApiModelService::FillCityDetailsApiModel($item->city),
            'phones' => FillApiModelService::FillPhonesListApiModel($item->placePhones),
            'views_count' => $item->views_count,
        ]);
        return $model;
    }

    public static function FillMapLocationApiModel($item)
    {
        $model = new MapLocationApiModel([
            'lat' => $item->lat,
            'lng' => $item->lng,
        ]);
        return $model;
    }

    public static function FillPhonesListApiModel($items)
    {
        $models = [];
        foreach ($items as $one){
            $models[] = new PhoneApiModel([
                'phone' => $one->phone,
            ]);
        }
        return $models;
    }

    public static function FillImagesListApiModel($items)
    {
        $models = [];
        foreach ($items as $one){
            $models[] = new ImageApiModel([
                'url' => $one->imageUrl,
            ]);
        }
        return $models;
    }

    public static function FillPlaceDetailsApiModel($item)
    {
        $lang = api_lang();
        //        $name_attr = $lang.'_name';
        $name_attr = 'name';

        $model = new PlaceDetailsApiModel([
            'id' => $item->id,
            'name' => $item->$name_attr,
            'image' => $item->imageUrl,
            'category' => FillApiModelService::FillCategoryDetailsApiModel($item->category),
            'city' => FillApiModelService::FillCityDetailsApiModel($item->city),
            'map_location' => FillApiModelService::FillMapLocationApiModel($item),
            'address' => $item->address,
            'phones' => FillApiModelService::FillPhonesListApiModel($item->placePhones),
            'images' => FillApiModelService::FillImagesListApiModel($item->placeImages),
            'email' => $item->email,
            'site_url' => $item->site_url,
            'facebook_url' => $item->facebook_url,
            'instagram_url' => $item->instagram_url,
            'description' => $item->description,
            'services' => FillApiModelService::FillServicesApiModel($item->placeServices),
            'open_times' => FillApiModelService::FillOpenDaysApiModel($item->week_days),
            'views_count' => $item->views_count,
        ]);
        return $model;
    }

    public static function FillServicesApiModel($items)
    {
        $models = [];
        foreach ($items as $one){
            $models[] = new ServiceApiModel([
                'id' => $one->id,
//                'service' => $one->text,
                'service' => $one->service->service,
            ]);
        }
        return $models;
    }

    public static function FillOpenDaysApiModel($items)
    {
        $models = [];
        foreach ($items as $one){
            $models[] = new OpenDayApiModel([
                'day' => $one->day,
                'dayOfWeek' => WeekDays::DayOfWeek($one->day),
                'openTime' => $one->from,
                'closingTime' => $one->to,
            ]);
        }
        return $models;
    }


    public static function FillPhoneGuideApiModel($item)
    {
        $model = new PhoneGuideApiModel([
            'id' => $item->id,
            'name' => $item->name,
            'phone' => $item->phone,
        ]);
        return $model;
    }

}
