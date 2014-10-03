<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
include ('appConfig.php');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'УкрЯма',
	'language'=>'ua',
	'defaultController'=>'holes',
	// preloading 'log' component
	//'layout'=>'startpage',
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
                'ext.YiiMailer.YiiMailer',
	),
	'modules'=>array(
		
			'gii'=>array(
				'class'=>'system.gii.GiiModule',
				'password'=>'root',
				'ipFilters' => array('127.0.0.1'),
				'generatorPaths' => array(
				'ext.giix-core',
				),
			),		
			'userGroups'=>array(
				'accessCode'=>'12345',
				'salt'=>'111',				
				'profile'=>Array('Profile')
			),
            'comments'=>array(
    				//you may override default config for all connecting models
    				'defaultModelConfig' => array(
					//only registered users can post comments
					'registeredOnly' => true,
					'useCaptcha' => false,
					//allow comment tree
					'allowSubcommenting' => true,
					//display comments after moderation
					'premoderate' => false,
					//action for postig comment
					'postCommentAction' => 'comments/comment/postComment',
					//super user condition(display comment list in admin view and automoderate comments)
					'isSuperuser'=>'Yii::app()->user->isModer',
					//order direction for comments
					'orderComments'=>'ASC',					
				),
				//the models for commenting
				'commentableModels'=>array(
					//model with individual settings
					'Holes'=>array(
						'registeredOnly'=>true,
						'useCaptcha'=>false,
						'allowSubcommenting'=>true,
						//config for create link to view model page(page with comments)
						'pageUrl'=>array(
							'route'=>'holes/view',
							'data'=>array('id'=>'ID'),
						),
					),
					//model with default settings
					'ImpressionSet',
				),
				//config for user models, which is used in application
				'userConfig'=>array(
					'class'=>'UserGroupsUser',
					'nameProperty'=>'fullname',
					//'emailProperty'=>'email',
				),
			),
    ),
	// application components
	'components'=>array(
		'user'=>array(
      	'allowAutoLogin'=>true,
		'class'=>'userGroups.components.WebUserGroups',

		),

	'Printer' => array(
	'class' => "ext.file-printer.Printer",
	'params' => array(
		'templates' => 'webroot.forms',
		),
	),

        'ePdf' => array(
        'class'         => 'ext.yii-pdf.EYiiPdf',
        'params'        => array(
            'mpdf'     => array(
                'librarySourcePath' => 'application.vendors.mpdf.*',
                'constants'         => array(
                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                ),
                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                    'mode'              => '', //  This parameter specifies the mode of the new document.
                    'format'            => 'A4', // format A4, A5, ...
                    'default_font_size' => 0, // Sets the default document font size in points (pt)
                    'default_font'      => '', // Sets the default font-family for the new document.
                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                    'mgr'               => 15, // margin_right
                    'mgt'               => 16, // margin_top
                    'mgb'               => 16, // margin_bottom
                    'mgh'               => 9, // margin_header
                    'mgf'               => 9, // margin_footer
                    'orientation'       => 'P', // landscape or portrait orientation
                )*/
            )
        ),
    ),

        'urlManager'=>array(
			//'baseUrl'=>'/',
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'urlSuffix'=>'/',
			'rules'=>array(
				  '/'=>'holes/index',
				  '<id:\d+>'=>'holes/view',
				  'map'=>'holes/map',
				  'page/<view:\w+>/' => 'site/page',
				  'kyiv' => 'site/kyiv',
				  'payment' => 'site/payment',
				  'userGroups'=>'userGroups',
				  'gii'=>'gii',
				  'profile'=>'profile',
				  'api/<id:\d+>'=>'api/index',
				  'api/my/<id:\d+>/update'=>'api/update',
				  'api/my/<id:\d+>/<type:[a-zA-Z0-9\_]+>'=>'api/setstate',
				   '<controller:\w+>'=>'<controller>/index',
				  '<controller:\w+>/<id:\d+>'=>'<controller>/view',
				  '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				  '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

			),

		),
            
            

		'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
        ),

		'loid' => array(
			'class' => 'application.extensions.lightopenid.loid',
		),
		
		 'eauth' => array(
			'class' => 'ext.eauth.EAuth',
			'popup' => true, // Use the popup window instead of redirecting.
			'services' => $socials,
		),

		'db'=>$bd,
		       /*  'log' => array(
             'class' => 'CLogRouter',
             'routes' => array(
                 array(
                     'class' => 'CFileLogRoute',
                     'categories' => 'system.db.CDbCommand',
                     'levels' => 'trace, info, error, warning',
                 ),
                 array(
                     'class' => 'CWebLogRoute',
                 ),
             ),
         ),*/
         'log'=>array(
          'class'=>'CLogRouter',
          'routes'=>array(
              array(
                  'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                  'ipFilters'=>array('127.0.0.1'),
              ),
          ),
   ),
                   

		
		'cache'=>array(
            'class'=>'system.caching.CDummyCache',          
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),			


		 'widgetFactory'=>array(
			'enableSkin'=>true,
            'widgets'=>array(
                /*'CGridView'=>array(
                    'cssFile'=>'/css/gridview/styles.css',
                ),
                'CTabView'=>array(
                    'cssFile'=>'/css/CTabView/styles.css',
                ),
                'CDetailView'=>array(
                    'cssFile'=>'/css/CDetailView/styles.css',
                ),*/
                'CJuiDatePicker'=>array(
                    'language'=>'ru',
                ),
                'CLinkPager'=>array(
                    'maxButtonCount'=>10,
					'lastPageLabel'=>false, 
					'firstPageLabel'=>false, 
					'nextPageLabel'=>'&rarr;',
					'prevPageLabel'=>'&larr;',
					'cssFile'=>false,
					'header'=>false,
                    //'cssFile'=>false,
                ),
            ),
        ),


	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array_merge($params, array("upload_ext"=>array('mp4','flv', 'ogv', 'jpg', 'png', 'jpeg', 'mov', 'webm'), "upload_path"=>'/upload/events/')),
);
