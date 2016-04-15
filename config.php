<?php

use humhub\modules\user\widgets\AccountMenu;
use humhub\modules\space\widgets\Menu;

return [
    'id' => 'newsletters',
    'class' => 'humhub\modules\newsletters\Module',
    'namespace' => 'humhub\modules\newsletters',
    'events' => [
        # Add Newsletters to User Profile Menu
        ['class' => AccountMenu::className(), 'event' => AccountMenu::EVENT_INIT, 'callback' => ['humhub\modules\newsletters\Events', 'onUserAccountMenuInit']],
        # Add newsletters to Space Menu
        ['class' =>Menu::className(), 'event' => Menu::EVENT_INIT, 'callback' => ['humhub\modules\newsletters\Events', 'onSpaceMenuInit']],
    ],
];

?>
