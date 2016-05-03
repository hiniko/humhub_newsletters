<?php

namespace humhub\modules\newsletters\widgets;

use humhub\components\Widget;
use humhub\modules\newsletters\models\Subscription;

class Subscribers extends Widget
{
    public $space_id;

    public function run()
    {

        $subscription = new Subscription();
        return $this->render('subscribers',
            [
                'space_id' => $this->space_id,
                'searchModel' => $subscription,
                'dataProvider' => $subscription->getDataProvider($this->space_id),
            ]
        );
    }
}

?>
