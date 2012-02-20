<?php

class m120220_075558_create_users_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{users}}', array(
			'user_id'=> 'int(11) NOT NULL AUTO_INCREMENT',
			'email'=> 'varchar(50) NOT NULL',
			'name'=> 'varchar(25) DEFAULT NULL',
			'create_date'=> 'timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP',
			'PRIMARY KEY (user_id)',
		),'ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3');
	}

	public function down()
	{
		$this->dropTable('{{users}}');
	}
}