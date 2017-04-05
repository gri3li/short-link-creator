<?php

use yii\db\Migration;

class m170405_132733_init extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%link}}', [
            'id'            => $this->string(6)->notNull(),
            'link'          => $this->string()->notNull(),
            'statistic_url' => $this->string()->notNull(),
            'end_date'      => $this->integer(),
        ], $tableOptions);
        $this->addPrimaryKey('pk-link', '{{%link}}', 'id');
        $this->createIndex('statistic_url', '{{%link}}', 'statistic_url', true);

        $this->createTable('{{%statistic}}', [
            'id'         => $this->primaryKey(),
            'link_id'    => $this->string(6)->notNull(),
            'created_at' => $this->integer(),
            'useragent'  => $this->string(),
            'city'       => $this->string(),
            'country'    => $this->string(),
        ], $tableOptions);
        $this->createIndex('link_id', '{{%statistic}}', 'link_id');

        $this->addForeignKey('fk-link-statistic', '{{%statistic}}', 'link_id', '{{%link}}', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-link-statistic', '{{%statistic}}');

        $this->dropTable('{{%link}}');
        $this->dropTable('{{%statistic}}');
    }
}
