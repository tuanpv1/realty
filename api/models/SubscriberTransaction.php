<?php
/**
 * Created by PhpStorm.
 * User: VS9 X64Bit
 * Date: 25/02/2015
 * Time: 9:03 AM
 */

namespace api\models;

class SubscriberTransaction extends \common\models\SubscriberTransaction {

    public function fields() {
        $fields = parent::fields();
        unset($fields['created_at']);
        unset($fields['updated_at']);
        unset($fields['shortcode']);
        unset($fields['event_id']);
        unset($fields['error_code']);
        unset($fields['subscriber_activity_id']);
        unset($fields['subscriber_service_asm_id']);
        unset($fields['site_id']);
        unset($fields['dealer_id']);
        unset($fields['application']);

        $fields['service_name'] = function ($model) {
            /* @var $model \common\models\SubscriberTransaction */
            return $model->service? $model->service->name: '';
        };
        $fields['content_name'] = function ($model) {
            /* @var $model \common\models\SubscriberTransaction */
            return $model->content? $model->content->display_name: '';
        };
        $fields['status_name'] = function ($model) {
            /* @var $model \common\models\SubscriberTransaction */
            return $model->getStatusName();
        };
        $fields['type_name'] = function ($model) {
            /* @var $model \common\models\SubscriberTransaction */
            return $model->getTypeName();
        };
        $fields['channel_name'] = function ($model) {
            /* @var $model \common\models\SubscriberTransaction */
            return $model->getChannelName();
        };
        return $fields;
    }

}