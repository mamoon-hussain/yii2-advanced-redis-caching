<?php


namespace common\models\notifications;


use common\models\Admin;
use common\models\User;
use phpDocumentor\Reflection\Types\Integer;

interface INotification
{

    /**
     * INotification constructor.
     * @param null $model
     */
    public function __construct($model = Null);

    /**
     * @param Notification $notification
     * @param bool $toMe
     * @return bool
     */
    public static function send(Notification $notification, bool $toMe = false): bool;

    /**
     * return the id the data that wll be attached to the notification
     * @return string
     */
    public function getDataId();

    /**
     * notification title
     * @param User $user
     * @return string
     */
    public function getTitle($user): string;

    /**
     * notification body
     * @param User $user
     * @return string
     */
    public function getTranslatedBody($user): string;

    /**
     * firebase data with custom data
     * @return array
     */
    public function getData(): array;

    /**
     * transfer the model object
     * @return mixed
     */
    public function getCustomData(User $user = null);

    /**
     * the type of notification from NotificationType Enum
     * @return int
     */
    public function getNotificationType(): int;

    /**
     * array for user id
     * @return array
     */
    public function getUsersId(): array;

    /**
     * array of users who will receive the notification
     * @return User[]
     */
    public function getUsers(): array;

    /**
     * @param User $user
     */
    public function toFireBase(User $user): void;

    /**
     * @param User $user
     */
    public function toDatabase(Admin $user): void;

    /**
     * notification URL
     * @return string
     */
    public function url(): string;

    public function image(): string;
}