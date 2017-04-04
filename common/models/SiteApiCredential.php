<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%service_provider_api_credential}}".
 *
 * @property integer $id
 * @property string $client_name
 * @property integer $type
 * @property string $client_api_key
 * @property string $client_secret
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Site $site
 */
class SiteApiCredential extends \yii\db\ActiveRecord
{

    /**
     * can co api key va secret key
     */
    const TYPE_WEB_APPLICATION = 0;

    /**
     * can co api key, package name va fingerprint
     */
    const TYPE_ANDROID_APPLICATION = 1;

    /**
     * can co api key, secret key, bundle id va appstore id
     */
    const TYPE_IOS_APPLICATION = 2;
    const TYPE_WINDOW_PHONE_APPLICATION = 3;

    const STATUS_INACTIVE= 0;
    const STATUS_ACTIVE = 10;
    const STATUS_REMOVE = -1;

    public static $api_key_types = [
        self::TYPE_WEB_APPLICATION => "Web",
        self::TYPE_ANDROID_APPLICATION => "Android",
        self::TYPE_IOS_APPLICATION => "IOS",
    ];
    public static $credential_status = [
         self::STATUS_INACTIVE => 'IN ACTIVE',
        self::STATUS_ACTIVE => 'ACTIVE',
    ];


    /**
     * @inheritdoc
     */


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    public static function tableName()
    {
        return '{{%site_api_credential}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $webapp = function ($model) {
            return $model->type == self::TYPE_WEB_APPLICATION;
        };
        $android = function ($model) {
            return $model->type == self::TYPE_ANDROID_APPLICATION;
        };
        $ios = function ($model) {
            return $model->type == self::TYPE_IOS_APPLICATION;
        };
        return [
            [['client_name', 'client_api_key'], 'required'],
            [['client_secret'], 'required', 'when' => $webapp],
            [['type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['client_name'], 'string', 'max' => 200],
            [['client_api_key', 'client_secret'], 'string', 'max' => 128],
            [['description'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_name' => Yii::t('app', 'Client Name'),
            'type' => Yii::t('app', 'Type'),
            'client_api_key' => Yii::t('app', 'Client Api Key'),
            'client_secret' => Yii::t('app', 'Client Secret'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Udpated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'site_id']);
    }

    public static function findCredentialByApiKey($apiKey) {
        return self::findOne(['client_api_key' => $apiKey, 'status' => static::STATUS_ACTIVE]);
    }
}
