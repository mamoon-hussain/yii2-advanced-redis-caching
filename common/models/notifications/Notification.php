<?php


namespace common\models\notifications;


use common\enums\Constents;
use common\enums\NotificationType;
use common\enums\UserTypeEnum;
use common\models\Admin;
use common\models\GlobalUser;
use common\models\NotificationSetting;
use common\models\User;
use common\services\AdminService;
use paragraph1\phpFCM\Recipient\Device;
use understeam\fcm\Client;
use yii\base\BaseObject;

abstract class Notification implements INotification
{
    const NOTIFICATION_URL = 'http://localhost/painter/admin/en/notification/send-notification';

    public $saveToDataBase = true;
    public $sendToFirebase = false;

    /** @var BaseObject $model */
    protected $model;

    public function __construct($model = Null)
    {
        $this->model = $model;
    }

    public static function send(Notification $notification, bool $toMe = false): bool
    {
//        $curlHandler = curl_init();
//        $headers = [
//            'Content-Type: application/json',
//        ];
//        $data = '?type=' . $notification->getNotificationType() . '&dataId=' . ($notification->model ? $notification->model->id : null);
//        curl_setopt_array($curlHandler, [
//            CURLOPT_URL => self::NOTIFICATION_URL . $data,
//            CURLOPT_HTTPHEADER => $headers,
//            CURLOPT_RETURNTRANSFER => true,
//
////            /**
////             * Specify POST method
////             */
////            CURLOPT_POST => true,
////
////            /**
////             * Specify array of form fields
////             */
////            CURLOPT_POSTFIELDS => Json::encode($data),
//
//            CURLOPT_TIMEOUT => 1,
//        ]);
//        $response = curl_exec($curlHandler);
//        stopv($response);
//        curl_close($curlHandler);
//        exit;

        /** @var User $user */
        foreach ($notification->getUsers() as $user) {
            if($notification->saveToDataBase){
                $notification->toDatabase($user);
            }

            if ($notification->sendToFirebase && $user->firebase_token) {
                $notification->toFireBase($user);
            }

        }

        return true;
    }

    public function toFireBase(User $user): void
    {
        /** @var Client $fcm */
        $fcm = \Yii::$app->fcm_understeam;
        $note = $fcm->createNotification($this->getTitle($user), $this->getTranslatedBody($user));
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = $fcm->createMessage();
        $message->addRecipient(new Device($user->firebase_token));
        $data_array = [];
        foreach ($this->getData() as $one) {
            $data_array[$one->key] = $one->value;
        }
        $message->setNotification($note)->setData($data_array);

        $response = $fcm->send($message);

        //        return $response->getStatusCode();
    }

    public function getTitle($user): string
    {
        return NotificationType::Labels()[$this->getNotificationType()];
    }

    public function getData(): array
    {
        return [
            (object)[
                'key' => 'type',
                'value' => $this->getNotificationType()
            ],
            (object)[
                'key' => 'data',
                'value' => $this->getCustomData()
            ],
            (object)[
                "key" => "click_action",
                "value" => "FLUTTER_NOTIFICATION_CLICK"
            ]
        ];
    }

    public static function sendNotification(Notification $notification): bool
    {
        /** @var User $user */
        foreach ($notification->getUsers() as $user) {
            if ($notification->saveToDataBase) {
                $notification->toDatabase($user);
            }
            if ($notification->sendToFirebase && $user->firebase_token) {
                $notification->toFireBase($user);
            }
        }

        return true;
    }

    public function getUsers(): array
    {
//        $users = User::find()
//            ->andWhere(['in', User::tableName() . '.id', $this->getUsersId()])
//            ->all();
        $users = Admin::find()
            ->all();
        return $users;
    }

    public function toDatabase(Admin $user): void
    {
        $notification = new \common\models\Notification();

        $notification->user_id = $user->id;
        //$notification->user_type = 2; //$user->type;

        $notification->title = $this->getTitle($user);
        $notification->body = $this->getTranslatedBody($user);
        $notification->data_id = $this->model ? $this->model->id : null;
        $notification->type = $this->getNotificationType();

        $notification->create_date = date(Constents::full_date_format);
        $notification->is_read = 0;
        $notification->publish = 0;
        if (!$notification->save()) {
            stopv($notification->errors);
        }
    }
}
