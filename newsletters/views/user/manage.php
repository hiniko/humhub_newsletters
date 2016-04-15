<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="panel-heading">
    <strong>Newsletter</strong> subscriptions
</div>

<div class="panel-body">
    <p>Manage your subscription to space newsletters</p>

    <?php foreach ($availableModules as $moduleId => $module): ?>
        <hr>
        <div class="media">
            <a class="pull-left" href="#">
                <img src="<?php echo $module->getContentContainerImage($user); ?>"
                     class="" width="64" height="64">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $module->getContentContainerName($user); ?></h4>
                <p><?php echo $module->getContentContainerDescription($user); ?></p>

            </div>
        </div>
    <?php endforeach; ?>
</div>
