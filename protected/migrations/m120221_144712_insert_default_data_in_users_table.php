<?php

class m120221_144712_insert_default_data_in_users_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('{{users}}', array(
			'user_id'=> 1,
			'email'=> 'phpfour@gmail.com',
			'name'=> '',
			'create_date'=> '2012-01-23 07:36:06',
		));
	}

	public function safeDown()
	{
		$this->delete('{{users}}', 'user_id=1');
	}
}