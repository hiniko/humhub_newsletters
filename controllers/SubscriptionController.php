<?php

namespace humhub\modules\newsletters\controllers;

use Yii;
use yii\web\Controller;
use humhub\modules\newsletters\models\Newsletter;
use humhub\modules\newsletters\models\Subscription;

class SubscriptionController extends Controller {

    /*
     * Subscribes a user to the newsletter requested in the link
     * Checks that the get params contains the newsletter id and a controller
     * to redirect to after the action success or fails
     */
    public function actionSubscribe()
    {
        // Check we have a valid request, redirect immediatly if not
        list($newsletter, $redirectURL, $redirect) = $this->checkRequest(); 
        if($redirect) {
            return $this->redirect($redirectURL);
        }

        // Check user is not already subscribed
        $existing = Subscription::findOne([
            'newsletter_id' => $newsletter->guid,
            'user_id' => Yii::$app->user->id,
        ]);

        if($existing){
            Yii::$app->session->setFlash('error', 'You are already subscribed to this newsletter!');
            return $this->redirect($redirectURL);
        }

        // Create a new subscription for user
        $subscription = new Subscription();
        $subscription->newsletter_id = $newsletter->id;
        $subscription->user_id = Yii::$app->user->id;
        $subscription->space_id = $newsletter->space_id;
        $subscription->save();

        Yii::$app->session->setFlash('success', 'Subscription successful!');

        $this->redirect($redirectURL);
        
    }

    /*
     * Unsubscribes a user from a space's newsletter if it exists 
     */
    public function actionUnsubscribe()
    {
        // Check we have a valid request, redirect immediatly if not
        list($newsletter, $redirectURL, $redirect) = $this->checkRequest(); 
        if($redirect) {
            return $this->redirect($redirectURL);
        }

        $existing = Subscription::findOne([
            'newsletter_id' => $newsletter->id,
            'user_id' => Yii::$app->user->id,
        ]);

        if(!$existing){
            Yii::$app->session->setFlash('error', 'You are not subscribed to this newsletter!');
            return $this->redirect($redirectURL);
        }

        $existing->delete();
        Yii::$app->session->setFlash('sucess', 'Unsubscribed from '. $newsletter->name);

        return $this->redirect($redirectURL);
    }

    private function checkRequest()
    {
        // Check GET Prams are valid and redirect otherwise
        $newsletter_id = Yii::$app->request->get('newsletter_id');
        $redirectURL = Yii::$app->request->get('redirect');
        $redirect = false;


        if( $newsletter_id === null ){
            Yii::$app->session->setFlash('error', 'Bad subscription reqeust: No Newsletter ID');
            $redirect = true;

        }

        if( $redirectURL == null ){
            Yii::$app->session->setFlash('error', 'Bad subscription reqeust: No Redirect route');
            $redirect = true;
        }

        // Check that the newsletter exists
        $newsletter = Newsletter::findOne(['guid' => $newsletter_id]);
        if($newsletter == null){
            Yii::$app->session->setFlash('error', 'Bad subscription request: Newsletter does not exist!');
            $redirect = true;
        }

        return [$newsletter, $redirectURL, $redirect];
    }
}
?>
