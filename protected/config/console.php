<?php

include ('appConfig.php');
// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'assetManager'=>'assets', // потрібно запустити консоль.
	'name'=>'My Console Application',
        'preload'=>array('log'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.classes.*',
		'application.modules.userGroups.*',
		'application.modules.userGroups.models.*',
                'application.modules.userGroups.components.*',
                'application.modules.comments.models.*',
		'application.extensions.nestedset.*',
		'application.extensions.fpdf.*',
		'application.extensions.*',
		'application.helpers.*',
        	'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.services.*',
        
	),
	'modules'=>array(	
			'userGroups'=>array(
				'accessCode'=>'12345',
				'salt'=>'111',				
				'profile'=>Array('Profile')
			),
				//config for user models, which is used in application
				'userConfig'=>array(
					'class'=>'UserGroupsUser',
					'nameProperty'=>'fullname',
					//'emailProperty'=>'email',
				),
	),

	// application components
	'components'=>array(
		'db'=>$bd,
		'user'=>array(
			'allowAutoLogin'=>true,
			'class'=>'userGroups.components.WebUserGroups',
            ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'levels'=>'error, warning, info',
		            'logFile'=>'phplog-hey.log',
                    'enabled'=>'false',
                ),
                array(
                    'class' => 'application.extensions.pqp.PQPLogRoute',
                    'categories' => 'application.*, exception.*',
                ),
            ),
		//	'enabled'=>isset($_GET['testing'])?true:false,  // enable caching in non-debug mode  
		),
		

		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
	),
);
