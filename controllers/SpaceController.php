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
        $newsletter = Newsletter::findOne(['space_id' => $this->space->id]);

        $subscription = Subscription::findOne([
                'user_id' => Yii::$app->user->id,
                'space_id' => $this->space->id
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
       $newsletter = Newsletter::findOne(['space_id' => $this->space->id]);

       if ($newsletter === null){
           $newsletter = new Newsletter();
        }
       
       
       if ($newsletter->load(Yii::$app->request->post()) && $newsletter->validate()) {
           
           $newsletter->space_id = $this->space->id;
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
    
}
