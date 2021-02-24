<?php

namespace common\models\generated;

use Yii;

/**
 * This is the model class for table "app_info".
 *
 * @property int $id
 * @property string $description
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $mobile
 * @property string|null $site_url
 * @property string|null $facebook_url
 * @property string|null $instagram_url
 * @property string|null $youtube_url
 * @property string|null $twitter_url
 * @property string|null $home_description
 * @property string|null $video
 * @property string|null $image
 *
 * @property LocalizedAppInfo[] $localizedAppInfos
 */
class AppInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'required'],
            [['description', 'home_description'], 'string'],
            [['email', 'phone', 'mobile', 'site_url', 'facebook_url', 'instagram_url', 'youtube_url', 'twitter_url', 'video', 'image'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'email' => 'Email',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'site_url' => 'Site Url',
            'facebook_url' => 'Facebook Url',
            'instagram_url' => 'Instagram Url',
            'youtube_url' => 'Youtube Url',
            'twitter_url' => 'Twitter Url',
            'home_description' => 'Home Description',
            'video' => 'Video',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[LocalizedAppInfos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalizedAppInfos()
    {
        return $this->hasMany(LocalizedAppInfo::className(), ['item_id' => 'id']);
    }
}
