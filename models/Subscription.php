<?php

/**
 *
 *
 */

namespace humhub\modules\newsletters\models;
namespace humhub\modules\newsletters\models\Newsletter;

use Yii;
use humhub\components\ActiveRecord;

/**
 * This is the model class for table "Subscritpions"
 *
 * @property integer $id
 * @property integer $newsletter_id
 * @property integer $user_id
 * @property integer $space_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */


class Subscription extends ActiveRecord
{

    public static function tableName()
    {
        return 'newsletters_subscriptions';
    }
    
    public static function getUserSubscriptions($user_id)
    {
        return self::findAll(['user_id' => $user_id]);
    }

    public function getSubscription()
    {
        return $this->hasOne(Newsletter::className(), ['id' => 'newsletter_id']);
    }

}

?>
