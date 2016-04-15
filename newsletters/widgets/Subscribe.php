<?php

namespace humhub\modules\newsletters\widgets;

use humhub\components\Widget;

class Subscribe extends Widget
{
    public $subscription;
    public $newsletter;

    public function run()
    {
        return $this->render('subscribe', array(
            'subscription' => $this->subscription,
            'newsletter' => $this->newsletter,
        ));
    }
}

?>
