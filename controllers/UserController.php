<?php

namespace humhub\modules\newsletters\controllers;

use Yii;
use yii\web\Controller;
use humhub\modules\newsletters\models\Newsletter;
use humhub\modules\newsletters\models\Subscription;

class UserController extends Controller {

    public $subLayout = "@humhub/modules/user/views/account/_layout";

    public function actionManage()
    {
        
        $subscriptions = Subscription::getUserSubscriptions(Yii::$app->user->id);

        return $this->render('manage', [
            'subscriptions' => $subscriptions,
        ]);
    }
}
