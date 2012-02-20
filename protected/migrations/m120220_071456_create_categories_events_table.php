<?php

class m120220_071456_create_categories_events_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{categories_events}}', array(
			'category_id'=> 'int(11) NOT NULL',
			'event_id'=> 'int(11) NOT NULL',
		),'ENGINE=InnoDB DEFAULT CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('{{categories_events}}');
	}
}