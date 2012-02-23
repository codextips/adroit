<?php

class m120221_142203_insert_default_data_in_events_table extends CDbMigration
{
	public function up()
	{
		$this->insert('{{events}}', array(
			'event_id'=> 1,
			'user_id'=> 1,
			'title'=> 'PHPBenelux Conference 2012',
			'summary`'=> "The conference and tutorials will take place at the Best Western Hotel Ter Elst in Antwerp (Belgium). Friday morning January 27th we have a set of tutorials. The conference is spread over 2 days: Friday afternoon (after the tutorials) and Saturday. Tutorials as well as the conference itself are spread over several parallel tracks.\n\nOn Friday evening, we're having the conference social. This will include drinks and bowling as we managed to reserve the entire bowling alley.",
			'logo'=> 'http://joind.in/inc/img/event_icons/phpbnl2012-small.png',
			'location'=> 'Best Western Ter Elst',
			'href'=> 'http://conference.phpbenelux.eu/',
			'start_date'=> '2012-01-27',
			'end_date'=> '2012-01-29',
			'is_active'=> 1,
			'total_attending'=> 0,
			'create_date'=> '2012-01-20 10:11:12',
		));
		
		$this->insert('{{events}}', array(
			'event_id'=> 2,
			'user_id'=> 1,
			'title'=> 'ZendCon 2011',
			'summary`'=> 'The 7th Annual Zend PHP Conference (ZendCon) will take place October 17-20, 2011, in Santa Clara, California. ZendCon is the largest gathering of the PHP Community and brings together PHP developers and IT managers from around the world to discuss PHP best practices and explore new technologies.\r\n\r\nAt ZendCon, youâ€™ll learn from a variety of technical sessions and in-depth tutorials. International industry experts, renowned thought-leaders and experienced PHP practitioners, will discuss PHP best practices and explore future technological developments. ZendCon 2011 will focus on ways that PHP fits into major trends in the IT world. The primary conference themes are Cloud Computing, Mobile and User Experience, and Enterprise and Professional PHP.\r\n\r\nAn Exhibit Hall featuring industry leaders offers a space to meet innovative companies and unique networking opportunities are at hand.',
			'logo'=> '',
			'location'=> 'Santa Clara Convention Center',
			'href'=> 'http://joind.in/inc/img/event_icons/zendcon-icon.gif',
			'start_date'=> '2012-02-28',
			'end_date'=> '2012-03-29',
			'is_active'=> 1,
			'total_attending'=> 0,
			'create_date'=> '2012-01-24 10:13:46',
		));
		
		$this->insert('{{events}}', array(
			'event_id'=> 3,
			'user_id'=> 1,
			'title'=> 'PHPCon Poland 2011',
			'summary`'=> "The second edition of Polish weekend meeting for PHP programmers and enthusiasts. Attedees spend the time on lectures, workshops, lightning talks and after hours discussions to late night. There will be also a time for a little sightseeing - hotel is located in national park neighborhood.\r\n\r\nThe Official PHPConPL''s webpage has been just started. Talk proposals can be entered directly at phpcon.pl.",
			'logo'=> 'http://joind.in/inc/img/event_icons/logo-joind-in.png',
			'location'=> 'Przedwiosnie Hotel',
			'href'=> 'http://www.phpcon.pl/2011/en/',
			'start_date'=> '2012-03-07',
			'end_date'=> '2012-03-19',
			'is_active'=> 1,
			'total_attending'=> 0,
			'create_date'=> '2012-02-24 10:18:35',
		));
	}

	public function down()
	{
		$this->delete('{{events}}', 'event_id<4');
	}
}