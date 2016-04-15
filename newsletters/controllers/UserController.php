<?php

namespace humhub\modules\newsletters\controllers;

use Yii;
use yii\web\Controller;
use humhub\modules\newsletters\models\Newsletter;
use humhub\modules\newsletters\models\Subscription;

class UserController extends Controller {

    public function actionManage()
    {
        
        $subscriptions = Subscription::getUserSubscriptions(Yii::$app->user->id);

        $newsletter_ids = [];

        foreach($subscriptions as $sub){
            array_push($newsletter_ids, $sub->newsletter_id);
        }

        $newsletters = Newsletter::getNewsletters($newsletter_ids);

        return var_dump($subscriptions, $newsletter_ids, $newsletters);

        return $this->render('manage', [
            'subscriptions' => $subscriptions,
            'newsletters' => $newsletters
        ]);
    }
}
