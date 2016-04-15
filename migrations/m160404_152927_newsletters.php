<?php

use yii\db\Migration;

class m160404_152927_newsletters extends Migration
{
    public function up()
    {
        $this->createTable('newsletters_newsletters', array(
            'id' => 'pk',
            'space_id'  => 'int(11) NOT NULL',
            'guid' => 'TEXT NOT NULL',
            'name' => 'TEXT NOT NULL',
            'description' => 'TEXT NOT NULL',
            'frequency' => 'smallint(8) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(11) NOT NULL'
        ), '');

        $this->createTable('newsletters_subscriptions', array(
            'id' => 'pk',
            'user_id' => 'int(11) NOT NULL',
            'newsletter_id' => 'int(11) NOT NULL',
            'space_id' => 'int(11) NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(11) NOT NULL',
        ), '');

    }

    public function down()
    {
        $this->dropTable('newsletters_newsletters');
        $this->dropTable('newsletters_subscriptions');
    }

}

