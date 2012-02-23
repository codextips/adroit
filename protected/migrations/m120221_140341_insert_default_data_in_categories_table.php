<?php

class m120221_140341_insert_default_data_in_categories_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('{{categories}}', array(
			'category_id'=> 1,
			'title'=> 'PHP',
		));
		$this->insert('{{categories}}', array(
			'category_id'=> 2,
			'title'=> 'Ruby',
		));
		$this->insert('{{categories}}', array(
			'category_id'=> 3,
			'title'=> '.NET',
		));
	}

	public function safeDown()
	{
		$this->delete('{{categories}}', 'category_id<4');
	}
}