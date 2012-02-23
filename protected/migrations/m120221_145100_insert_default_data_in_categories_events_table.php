<?php

class m120221_145100_insert_default_data_in_categories_events_table extends CDbMigration
{
	public function up()
	{
		$this->insert('categories_events', array(
			'category_id'=>2,
			'event_id'=>2,
		));
		
		$this->insert('categories_events', array(
			'category_id'=>2,
			'event_id'=>1,
		));
		
		$this->insert('categories_events', array(
			'category_id'=>1,
			'event_id'=>3,
		));
		
		$this->insert('categories_events', array(
			'category_id'=>1,
			'event_id'=>2,
		));
		
		$this->insert('categories_events', array(
			'category_id'=>1,
			'event_id'=>1,
		));
		
		$this->insert('categories_events', array(
			'category_id'=>2,
			'event_id'=>3,
		));
	}

	public function down()
	{
		$this->delete('{{categories_events}}', 'category_id = 2 AND event_id = 2');
		$this->delete('{{categories_events}}', 'category_id = 2 AND event_id = 1');
		$this->delete('{{categories_events}}', 'category_id = 1 AND event_id = 3');
		$this->delete('{{categories_events}}', 'category_id = 1 AND event_id = 2');
		$this->delete('{{categories_events}}', 'category_id = 1 AND event_id = 1');
		$this->delete('{{categories_events}}', 'category_id = 2 AND event_id = 3');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}