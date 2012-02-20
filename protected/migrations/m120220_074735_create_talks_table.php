<?php

class m120220_074735_create_talks_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{talks}}', array(
			'talk_id'=> 'int(11) unsigned NOT NULL AUTO_INCREMENT',
			'event_id'=> 'int(11) DEFAULT NULL',
			'title'=> 'varchar(200) NOT NULL DEFAULT ""',
			'summary'=> 'text',
			'speaker'=> 'varchar(50) NOT NULL DEFAULT ""',
			'slide_link'=> 'varchar(200) DEFAULT NULL',
			'total_comments'=> 'int(11) DEFAULT 0',
			'rating'=> 'double NOT NULL DEFAULT 0',
			'rate_count'=> 'int(11) NOT NULL DEFAULT 0',
			'PRIMARY KEY (talk_id)',
			'FULLTEXT KEY search (title,summary,speaker)',
			'FULLTEXT KEY speaker (speaker)',
		),'ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ');
	}

	public function down()
	{
		$this->dropTable('{{talks}}');
	}
}