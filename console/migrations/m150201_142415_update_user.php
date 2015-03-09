<?php

use yii\db\Schema;
use common\components\db\Migration;

class m150201_142415_update_user extends Migration
{
    public function up()
    {
    	$this->addColumn('{{%user_info}}', 'location' , Schema::TYPE_STRING . '(10) DEFAULT NULL COMMENT "城市" AFTER `info`');
    	$this->addColumn('{{%user}}', 'tagline' , Schema::TYPE_STRING . '(40) DEFAULT NULL COMMENT "一句话介绍" AFTER `email`');
    }

    public function down()
    {
        echo "m150201_142415_update_user cannot be reverted.\n";
        $this->dropColumn('{{%user_info}}', 'location');
        $this->dropColumn('{{%user}}', 'tagline');
        return false;
    }
}
