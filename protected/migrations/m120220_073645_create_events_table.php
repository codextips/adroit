<?php

class m120220_073645_create_events_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{events}}', array(
			'event_id'=> 'int(11) NOT NULL AUTO_INCREMENT',
			'user_id'=> 'int(11) DEFAULT NULL',
			'title'=> 'varchar(200) DEFAULT NULL',
			'summary'=> 'text',
			'logo'=> 'varchar(200) DEFAULT NULL',
			'location'=> 'varchar(100) DEFAULT NULL',
			'href'=> 'varchar(200) DEFAULT NULL',
			'start_date'=> 'date DEFAULT NULL',
			'end_date'=> 'date DEFAULT NULL',
			'is_active'=> 'tinyint(1) DEFAULT 1',
			'total_attending'=> 'int(11) DEFAULT 0',
			'create_date'=> 'timestamp NULL DEFAULT CURRENT_TIMESTAMP',
			'PRIMARY KEY (event_id)',
			'FULLTEXT KEY search (title, summary, location)',
		),'ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11');
	}

	public function down()
	{
		$this->dropTable('{{events}}');
	}
}