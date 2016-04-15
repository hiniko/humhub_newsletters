<?php


namespace humhub\modules\newsletters\controllers;

use Yii;
use yii\web\HttpException;
use humhub\modules\content\components\ContentContainerController;
use humhub\modules\newsletters\models\Newsletter;
use humhub\modules\newsletters\models\Subscription;

class SpaceController extends ContentContainerController
{

    /*
     * Find the newsletter belonging to this space and the user subscription, 
     * if either exist
     */
    public function actionShow()
    {
        $newsletter = Newsletter::findOne(['space_id' => $this->space->guid]);
        $subscription = Subscription::findOne([
                'user_id' => Yii::$app->user->id,
                'space_id' => $this->space->guid
            ]);
        

        return $this->render('show', [
            'space' => $this->space,
            'contentContainer' => $this->contentContainer,
            'newsletter' => $newsletter,
            'subscription' => $subscription,
        ]);
    }

    /* Conifguration page for a space newsletter 
     *
     * Tries to find a newsletter for this space. If one is not found an empty
     * newsletter model is created for the form. On post, if a valid newsletter
     * model exists, it is validated and saved. Other wise the forms are shown
    */
    public function actionConfig()
    {
       $newsletter = Newsletter::findOne(['space_id' => $this->space->guid]);

       if ($newsletter === null){
           $newsletter = new Newsletter();
        }
       
       
       if ($newsletter->load(Yii::$app->request->post()) && $newsletter->validate()) {
           
           $newsletter->space_id = $this->space->guid;
           $newsletter->save();

           return $this->render('config', [ 
                'space' => $this->space,
                'newsletter' => $newsletter,
                'contentContainer' => $this->contentContainer,
            ]);

       } else {

           return $this->render('config', [ 
                'space' => $this->space,
                'newsletter' => $newsletter,
                'contentContainer' => $this->contentContainer,
            ]);
       }
    }
    
    /*
     * Check that we hae
     */
    public function actionSubscribe()
    {
        $newsletter_id = Yii::$app->request('newsletter_id');
        $redirect = Yii::$app->request('redirect');

        if( $newsletter_id === null ){
            Yii::$app->user->setFlash('error', 'Bad subsription reqeust: No Newsletter ID');
        }

        if( $redirect === null ){
            Yii::$app->user->setFlash('error', 'Bad subsription reqeust: No Redirect route');
        }

        $user_id = Yii::$app->user->id;
        $newsletter = Newsletter::findOne(['guid' => $newsletter_id]);
        if($newsletter === null){
            Yii::$app->user->setFlash('error', 'Newsletter does not exist!');
            $this->redirect($redirect);
        }

        $subscription = new Subscription();
        $subscription->newsletter_id = $newsletter_id;
        $subscription->user_id = $user_id;
        $subscription->space_id = $newsletter->space_id;
        $subscription->save();

        Yii::$app->user->setFlash('success', 'Subscription successful!');

        $this->redirect($redirect);
        
    }


}
