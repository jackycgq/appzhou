<?php

use yii\db\Schema;
use common\components\db\Migration;

class m150205_085033_update_app_comment extends Migration
{
    public function up()
    {
    	$this->addColumn('{{%app_comment}}', 'updated_at', Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'");
    	$this->addColumn('{{%app_comment}}', 'like_count', Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '喜欢数' AFTER `user_id`");
    }

    public function down()
    {
        echo "m150205_085033_update_app_comment cannot be reverted.\n";
        $this->dropColumn('{{%app_comment}}', 'updated_at');
        $this->dropColumn('{{%app_comment}}', 'like_count');
        return false;
    }
}