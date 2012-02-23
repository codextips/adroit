<?php

class m120221_144712_insert_default_data_in_users_table extends CDbMigration
{
	public function up()
	{
		$this->insert('{{users}}', array(
			'user_id'=> 1,
			'email'=> 'phpfour@gmail.com',
			'name'=> '',
			'create_date'=> '2012-01-23 07:36:06',
		));
	}

	public function down()
	{
		$this->delete('{{users}}', 'user_id=1');
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