<?php

namespace humhub\modules\newsletters;

use Yii;
use yii\helpers\Url;
use humhub\modules\space\models\Space;
use humhub\modules\user\models\User;

/**
 * Description of Events
 *
 * @author luke
 */
class Events extends \yii\base\Object
{

    /**
     * Add newsletter link to the user profile menu
     *
     * @param type $event            
     */
    public static function onUserAccountMenuInit($event)
    {

        if (Yii::$app->hasModule('newsletters')) {
            
            $event->sender->addItem(array(
                'label' => 'Newsletters',
                'group' => 'account',
                'url' => Url::toRoute('/newsletters/user/manage'),
                'icon' => '<i class="fa fa-envelope"></i>',
                'sortOrder' => 500,
                'isActive' => false,
            ));

        }
    }
    /**
     * Add Newsletters to Spaces Menu
     *
     * @param type $event            
     */
    public static function onSpaceMenuInit($event)
    {
        $space = $event->sender->space;

        if ($space->isModuleEnabled('newsletters')) {
            
            $event->sender->addItem(array(
                'label' => 'Newsletter',
                'group' => 'modules',
                'url' => $space->createUrl('/newsletters/space/show'),
                'icon' => '<i class="fa fa-envelope"></i>',
                'sortOrder' => 500,
                'isActive' => false,
            ));

        }
    }

}
