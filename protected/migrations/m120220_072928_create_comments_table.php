<?php

class m120220_072928_create_comments_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{comments}}', array(
			'comment_id'=> 'int(11) NOT NULL AUTO_INCREMENT',
			'event_id'=> 'int(11) DEFAULT NULL',
			'talk_id'=> 'int(11) DEFAULT NULL',
			'user_id'=> 'int(11) DEFAULT NULL',
			'body'=> 'text',
			'rating'=> 'tinyint(1) DEFAULT NULL',
			'is_private'=> 'tinyint(1) DEFAULT 0',
			'create_date'=> 'timestamp NULL DEFAULT CURRENT_TIMESTAMP',
			'PRIMARY KEY (comment_id)',
			'KEY event_id (event_id)',
		),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9');
	}

	public function down()
	{
		$this->dropTable('{{comments}}');
	}
}