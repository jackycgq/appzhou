<?php

use yii\db\Schema;
use common\components\db\Migration;

class m150104_071047_init_applist extends Migration
{
    public function up()
    {
        // App清单
        $tableName = '{{%applist}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '作者ID'",
            'title' => Schema::TYPE_STRING . " NOT NULL COMMENT '标题'",
            'excerpt' => Schema::TYPE_STRING . " DEFAULT NULL COMMENT '摘要'",
            'view_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '查看数'",
            'comment_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数'",
            'favorite_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '收藏数'",
            'like_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '喜欢数'",
            'status' => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '1' COMMENT '状态 1:发布 0：草稿'",
            'order' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '999' COMMENT '排序 0最大'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ]);
        $this->createIndex('user_id', $tableName, 'user_id');

        // App列表
        $tableName = '{{%applist_mate}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '作者ID'",
            'applist_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT 'App清单 ID'",
            'app_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT 'App ID'",
            'mark' => Schema::TYPE_STRING . " DEFAULT NULL COMMENT '备注'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ], $this->tableOptions);
    }

    public function down()
    {
        echo "m150104_071047_init_blog cannot be reverted.\n";
        $this->dropTable('{{%applist}}');
        $this->dropTable('{{%applist_mate}}');
        return false;
    }
}
