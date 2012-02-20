<?php

class m120220_070358_create_categories_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{categories}}', array(
			'category_id'=> 'int(11) NOT NULL AUTO_INCREMENT',
			'title'=> 'varchar(50) DEFAULT NULL',
			'PRIMARY KEY (category_id)',
		));
	}

	public function down()
	{
		$this->dropTable('{{categories}}');
	}
}