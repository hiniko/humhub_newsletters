<?php

use yii\db\Migration;

class uninstall extends Migration
{

    public function up()
    {
        $this->dropTable('newsletters_newsletters');
        $this->dropTable('newsletters_subscriptions');
    }

    public function down()
    {
        echo "Uninstall does not support migration down";
        return
    }

}
