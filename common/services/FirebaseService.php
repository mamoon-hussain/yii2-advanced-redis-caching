<?php

namespace common\services;

use api\models\notification\ListNotifications;
use common\enums\NotificationType;
use common\interfaces\IFirebaseInterface;
use common\models\Chat;
use common\models\Comment;
use common\models\Complaint;
use common\models\Feedback;
use common\models\notifications\comment\NewCommentNotification;
use common\models\notifications\comment\NewCommentReplyNotification;
use common\models\notifications\complaint\NewComplaintReplyNotification;
use common\models\notifications\message\NewMessageNotification;
use common\models\notifications\Notification;
use common\models\notifications\path\NewPathNotification;
use common\models\notifications\subject\NewSubjectNotification;
use common\models\notifications\subject\NewSubjectRateNotification;
use common\models\notifications\subject\NewSubjectSubscriptionNotification;
use common\models\notifications\subject\NewSurveyNotification;
use common\models\notifications\subject\ReminderNotification;
use common\models\notifications\topic\UpdateTopicNotification;
use common\models\Path;
use common\models\Review;
use common\models\Subject;
use common\models\Topic;
use common\models\UserSubscription;
use paragraph1\phpFCM\Recipient\Device;

class FirebaseService {

    public static function send($device_token, $title, $body, $data = []) {
        $note = \Yii::$app->fcm->createNotification($title, $body);
        $note->setIcon('notification_icon_resource_name')
            ->setColor('#ffffff')
            ->setBadge(1);

        $message = \Yii::$app->fcm->createMessage();
        $message->addRecipient(new Device($device_token));
        $data_array = [];
        foreach ($data as $one){
            $data_array[$one->key] = $one->value;
        }
        $message->setNotification($note)->setData($data_array);

        $response = \Yii::$app->fcm->send($message);
        return $response->getStatusCode();
    }




}
