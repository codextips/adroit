<?php

class m120218_111840_create_attendees_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{attendees}}', array(
			'event_id'=> 'int(11) NOT NULL',
			'user_id'=> 'int(11) NOT NULL',
			'PRIMARY KEY (event_id,user_id)',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('{{attendees}}');
	}
}