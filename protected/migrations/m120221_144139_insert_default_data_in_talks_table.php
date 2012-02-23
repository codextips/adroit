<?php

class m120221_144139_insert_default_data_in_talks_table extends CDbMigration
{
	public function up()
	{
		$this->insert('{{talks}}', array(
			'talk_id'=> 1,
			'event_id'=> 2,
			'title'=> 'Profiling PHP Applications',
			'summary'=> 'The web is full of advice focussed on improving performance. Before you can optimise however, you need to find out if your code is actually slow; then you need to understand the code; and then you need to find out what you can optimise.\n\nThis talk introduces various tools and concepts to optimise the optimisation of your PHP applications.',
			'speaker'=> 'Derick Rethans',
			'slide_link'=> '',
		));
	}

	public function down()
	{
		$this->delete('{{talks}}', 'talk_id=1');
	}
}