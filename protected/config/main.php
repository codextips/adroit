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
		'bootstrap',
		),
	// autoloading model and component classes
    'import' => array(
		'application.models.*',
		'application.components.*',
        'application.libs.*',
	),
    'modules' => array(
		// uncomment the following to enable the Gii tool
		
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'adroit',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array(
				'bootstrap.gii', // since 0.9.1
			),
		),
	),
	// application components
    'components' => array(
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
                array('bdEventsApi/consume', 'pattern'=>'bdeventsapi/consume/<model:\w+>', 'verb'=>'GET'),
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
        'bootstrap' => array(
            'class' => 'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
            'coreCss' => true, // whether to register the Bootstrap core CSS (bootstrap.min.css), defaults to true
            'responsiveCss' => false, // whether to register the Bootstrap responsive CSS (bootstrap-responsive.min.css), default to false
            'plugins' => array(
				// Optionally you can configure the "global" plugins (button, popover, tooltip and transition)
				// To prevent a plugin from being loaded set it to false as demonstrated below
                'transition' => false, // disable CSS transitions
                'tooltip' => array(
                    'selector' => 'a.tooltip', // bind the plugin tooltip to anchor tags with the 'tooltip' class
                    'options' => array(
                        'placement' => 'bottom', // place the tooltips below instead
					),
				),
				// If you need help with configuring the plugins, please refer to Bootstrap's own documentation:
				// http://twitter.github.com/bootstrap/javascript.html
			),
		),
        /*
          'db'=>array(
          'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
          ),
         */
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
		'bd_events_api' =>"http://192.168.1.4/api/",
    ),
);