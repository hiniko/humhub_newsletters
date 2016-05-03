<?php

/**
 *
 *
 */

namespace humhub\modules\newsletters\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use humhub\components\ActiveRecord;
use humhub\modules\user\models\User;


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
        return self::find()
            ->where(['user_id' => $user_id])
            ->with('newsletter.space')
            ->all();
    }

    public function getDataProvider($space_id){

        $query = Subscription::find()
            ->where(['space_id' => $space_id])
            ->joinWith('user');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataProvider;
    } 

    public function getUnsubscribeURL()
    {
        return Url::toRoute(
            [
                'subscription/unsubscribe',
                'newsletter_id' => $this->newsletter->guid,
                'redirect' => Yii::$app->request->getURL(),
            ] 
        );
    }

    public function getNewsletter()
    {
        return $this->hasOne(Newsletter::className(), ['id' => 'newsletter_id']);
    }

    public function getSubscription()
    {
        return $this->hasOne(Newsletter::className(), ['id' => 'newsletter_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

}

?>
