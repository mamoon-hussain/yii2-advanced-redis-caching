<?php


namespace common\models\notifications\request;


use common\enums\NotificationType;
use common\models\notifications\Notification;
use common\models\Request;
use common\models\User;
use common\services\FillApiModelService;

class NewRequestNotification extends Notification
{

    /** @var Request */
    protected $model;

    public function getUsersId(): array
    {
        return [
//            $this->model->user_id, // owner
        ];
    }

    public function getNotificationType(): int
    {
        return NotificationType::new_request;
    }

    public function getTranslatedBody($user): string
    {
        return \Yii::t(
            'all',
            'New request',
            [
//                'request' => $this->model->service->name,
            ]
//            ,$user->language
        );
    }

    public function getCustomData(User $user = null)
    {
        return [
            'modelId' => $this->model->id,
//            'modelService' => $this->model->service->name,
//            'object' => FillApiModelService::FillRequestApiModel($this->model)
        ];
    }

    public function url(): string
    {
        return \Yii::$app->urlManager->createUrl(['/request/view', 'id' => $this->model->id]);
    }

    public function image(): string
    {
        return user()->imageUrl;
    }

    public function getDataId()
    {
        return $this->model->id;
    }
}