<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Tech Adda',
	// preloading 'log' component
    'preload' => array(
		'log',
		//'bootstrap',
		),
	// autoloading model and component classes
    'import' => array(
		'application.models.*',
		'application.components.*',
        'application.libs.*',
	),
    'modules' => array(
	),
	// application components
    'components' => array(
		'fixture'=>array(
			'class'=>'system.test.CDbFixtureManager',
		),
        'user' => array(
			// enable cookie-based authentication
            'allowAutoLogin' => true,
            'autoUpdateFlash' => false,
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=> false,
			'rules'=>array(
                // REST patterns
                array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
                array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
                array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),  // Update
                array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
                array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'), // Create
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'events/admin'=>'events/admin',
				'events/search'=>'events/search',
				'events/create'=>'events/create',
				'events/view/<id:\d+>'=>'events/view',
				'events/update/<id:\d+>'=>'events/update',
                'events/attending'=>'events/attending',
				'events/<type>'=>'events/index',
				'events/<type>/category/<category>'=>'events/index',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
        // uncomment the following to use a MySQL database

        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=adroit',
            'emulatePrepare' => true,
            'tablePrefix' => '',
            'username' => 'adroit',
            'password' => 'adroit',
            'charset' => 'utf8',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
            /*
              array(
              'class'=>'CWebLogRoute',
              ),
             */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'host' => 'localhost',
        'openid.google' => 'https://www.google.com/accounts/o8/id',
        'openid.yahoo' => 'https://me.yahoo.com',
    ),
);