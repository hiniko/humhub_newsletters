<?php
namespace humhub\modules\newsletters\widgets;

use humhub\components\Widget;

class Newsletter extends Widget
{
    public $newsletter;
    public $subscription;

    public function run()
    {
        return $this->render('newsletter', array(
            'newsletter' => $this->newsletter,
            'subscription' => $this->subscription,
        ));
    }
}

?>
