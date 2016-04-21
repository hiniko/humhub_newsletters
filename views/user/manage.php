<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\newsletters\widgets\Subscribe;

?>
<div>
    <div class="panel-heading">
        <strong>Newsletter</strong> subscriptions
    </div>

    <div class="panel-body">
        <p>Manage your subscription to space newsletters</p>
        <hr />

        <?php 
            if (count($subscriptions) > 0):
                foreach ($subscriptions as $sub): ?>
            <hr>
            <div class="media">
                <div class="pull-right">
                    <?= Subscribe::widget([
                        'subscription' => $sub,
                        'newsletter' => $sub->newsletter,
                    ]);?>
                <hr />
                <?php                
                    $button = Html::tag('i', '', ['class' => 'fa fa-arrow-right']);
                    echo Html::a($button . ' Go To Space', 
                        [
                            '/space/space/', 
                            'sguid' => $sub->newsletter->space->guid,
                        ],
                        [
                            'class' => 'btn btn-primary'
                        ]);

                ?>

                </div>
                <div class="media-body">
                    <h4><?= $sub->newsletter->name; ?> </h4>
                    <p><?= $sub->newsletter->description; ?></p>
    
                </div>
            </div>
        <?php endforeach; else: ?>
        <p><strong>You are not subscribed to any newsletters.</strong></p>
        <?php endif; ?>
    </div>
</div>
