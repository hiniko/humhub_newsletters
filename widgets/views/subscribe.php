<?php
    use yii\helpers\Html;
    /*
     * Display Subscribe button if the user is *not* subscribed to this spaces
     * newsletter. Show unsubscribe button other wise.
     */

    $action = ($subscription) ? 'unsubscribe' : 'subscribe';

    $button = Html::tag('i', '', ['class' => 'fa fa-plus']);
    echo Html::a($button . " " . ucwords($action), 
        [
            '/newsletters/subscription/'.$action, 
            'newsletter_id' => $newsletter->guid,
            'redirect' => Yii::$app->request->getURL(),
        ],
        [
            'class' => 'btn btn-primary'
        ]);
?>
