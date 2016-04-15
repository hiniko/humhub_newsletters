<?php

namespace humhub\modules\newsletters;

use Yii;
use yii\helpers\Url;
use humhub\models\Setting;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;
use humhub\modules\content\components\ContentContainerModule;


class Module extends ContentContainerModule
{
    
    public function getContentContainerTypes()
    {
        return [
            Space::className()
        ];
    }


    public function getConfigUrl()
    {
        return Url::to(['/newsletters/config/config']);
    }

    public function getContentContainerConfigUrl($space)
    {
        return Url::to(['/newsletters/space/config', 'sguid' => $space->guid]);
    }

    /**
     * Enables this module
     */
    public function enable()
    {
        if (!Yii::$app->hasModule('newsletters')) {
            // set default config values
        }
        parent::enable();
    }

}

?>
