<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel-heading">
    <strong>Newsletter</strong> subscriptions
</div>

<div class="panel-body">
    <p>Manage your subscription to space newsletters</p>

    <?php foreach ($subscription as $sub): ?>
        <hr>
        <div class="media">
            <a class="pull-left" href="#">
                <?php echo $sub->id  ?>
            </a>
            <div class="media-body">
                <?php echo $sub->newsletter->title; ?>

            </div>
        </div>
    <?php endforeach; ?>
</div>
