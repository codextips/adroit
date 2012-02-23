<?php

class m120221_140925_insert_default_data_in_comments_table extends CDbMigration
{
	public function safeUp()
	{
		$this->insert('{{comments}}', array(
			'comment_id'=> 1,
			'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> 'Excellent session!',
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:01:53',
		));
		
		$this->insert('{{comments}}', array(
			'comment_id'=> 2,
			'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> "It did really open my eyes; as web developers we very often ignore the actual protocol that we're sending stuff through. Understanding the underlying mechanics of HTTP is indeed really important and even though I was half asleep the talk did indeed have many valid points and was nicely presented.",
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:11:34',
		));
		
		$this->insert('{{comments}}', array(
			'comment_id'=> 4,
			'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> "Great talk! It''s very nice to listen the basics explained by a master. Specially some basics I even knew about, thought.",
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:36:27',
		));
		$this->insert('{{comments}}', array(
			'comment_id'=> 5,
			'talk_id'=> 1,
			'user_id'=> 1,
			'body'=> "Although much of the talk was what you can see in Symfony2 caching documentation, but anyway it is a pleasure to hear Fabien live. Big todo to all of us, read the HTTP Specification.",
			'rating'=> '',
			'is_private'=> 0,
			'create_date'=> '2012-01-23 20:39:31',
		));
	}

	public function safeDown()
	{
		$this->delete('{{comments}}', 'comment_id IN(1,2,4,5)');
	}
}