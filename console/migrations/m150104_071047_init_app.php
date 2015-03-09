<?php

use yii\db\Schema;
use common\components\db\Migration;

class m150104_071047_init_app extends Migration
{
    public function up()
    {
    	// 分类
        $tableName = '{{%app_meta}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(100) DEFAULT NULL COMMENT '名称'",
            'type' => Schema::TYPE_STRING . "(32) DEFAULT NULL COMMENT '项目类型'",
            'description' => Schema::TYPE_STRING . " DEFAULT NULL COMMENT '选项描述'",
            'count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '项目所属内容个数'",
            'order' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '项目排序'",
            'parent' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '父级ID'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ], $this->tableOptions);
        $this->createIndex('type', $tableName, 'type');

        // App
        $tableName = '{{%app}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'app_meta_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '版块ID'",
            'used' => Schema::TYPE_STRING . "(32) DEFAULT NULL DEFAULT 'iPhone' COMMENT '应用类型'",
            'user_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '作者ID'",
            'title' => Schema::TYPE_STRING . " NOT NULL COMMENT '标题'",
            'excerpt' => Schema::TYPE_STRING . " DEFAULT NULL COMMENT '摘要'",
            'image' => Schema::TYPE_STRING . " DEFAULT NULL COMMENT '封面图片'",
            'content' => Schema::TYPE_TEXT . " NOT NULL COMMENT '内容'",
            'tags' => Schema::TYPE_STRING . " NOT NULL COMMENT '标签 用英文逗号隔开'",
            'view_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '查看数'",
            'comment_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '评论数'",
            'favorite_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '收藏数'",
            'like_count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '喜欢数'",
            'type' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '类型1收费 2免费 3限免'",
            'status' => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '1' COMMENT '状态 1:发布 0：草稿'",
            'order' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '999' COMMENT '排序 0最大'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ]);
        $this->createIndex('app_meta_id', $tableName, 'app_meta_id');
        $this->createIndex('tags', $tableName, 'tags');
        $this->createIndex('used', $tableName, 'used');
        $this->createIndex('user_id', $tableName, 'user_id');

        // 标签表
        $tableName = '{{%app_tag}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . "(20) DEFAULT NULL COMMENT '名称'",
            'count' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '计数'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ], $this->tableOptions);

        // 资源表
        $tableName = '{{%app_asset}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_INTEGER . " NOT NULL DEFAULT '1' COMMENT '类型1图片 2视频'",
            'app_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '应用ID'",
            'user_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '上传者ID'",
            'url' => Schema::TYPE_STRING . " NOT NULL COMMENT 'URL地址'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
            'updated_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '修改时间'",
        ], $this->tableOptions);

        // 评论表
        $tableName = '{{%app_comment}}';
        $this->createTable($tableName, [
            'id' => Schema::TYPE_PK,
            'parent' => Schema::TYPE_INTEGER . " UNSIGNED DEFAULT NULL COMMENT '父级评论'",
            'app_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL COMMENT '文章ID'",
            'comment' => Schema::TYPE_TEXT . " NOT NULL COMMENT '评论'",
            'status' => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT '1' COMMENT '1为正常 0为禁用'",
            'user_id' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL COMMENT '用户ID'",
            'ip' => Schema::TYPE_STRING . " NOT NULL COMMENT '评论者ip地址'",
            'created_at' => Schema::TYPE_INTEGER . " UNSIGNED NOT NULL DEFAULT '0' COMMENT '创建时间'",
        ], $this->tableOptions);
        $this->createIndex('app_id', $tableName, 'app_id');
        $this->createIndex('user_id', $tableName, 'user_id');
    }

    public function down()
    {
        echo "m150104_071047_init_blog cannot be reverted.\n";
        $this->dropTable('{{%app_meta}}');
        $this->dropTable('{{%app}}');
        $this->dropTable('{{%app_tag}}');
        $this->dropTable('{{%app_comment}}');
        $this->dropTable('{{%app_asset}}');
        return false;
    }
}
