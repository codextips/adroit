<?php

class m120224_185749_add_password_and_api_key_column_on_users_table extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{users}}', 'password', 'VARCHAR(128) DEFAULT NULL');
		$this->addColumn('{{users}}', 'api_key', 'VARCHAR(128) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('{{users}}', 'api_key');
		$this->dropColumn('{{users}}', 'password');
	}
}