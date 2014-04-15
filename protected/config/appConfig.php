<?php
$bd=array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=ukryama_ukryama',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix'=>'yii_',
			'schemaCachingDuration'=>3600,
			'enableProfiling' => true,
            'enableParamLogging' => true,
		);

$socials=array( // You can change the providers and their classes.
				/*'google' => array(
					'class' => 'GoogleOpenIDService',
				),*/
				'yandex' => array(
					'class' => 'YandexOpenIDService',
				),
				'twitter' => array(
					// регистрация приложения: https://dev.twitter.com/apps/new
					'class' => 'TwitterOAuthService',
					'key' => '',
					'secret' => '',
				),
				'google_oauth' => array(
					// регистрация приложения: https://code.google.com/apis/console/
					'class' => 'GoogleOAuthService',
					'client_id' => '',
					'client_secret' => '',
					'title' => 'Google',
				),
				'facebook' => array(
					// регистрация приложения: https://developers.facebook.com/apps/
					'class' => 'FacebookOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'vkontakte' => array(
					// регистрация приложения: http://vkontakte.ru/editapp?act=create&site=1
					'class' => 'VKontakteOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),
				'mailru' => array(
					'class' => 'MailruOpenIDService',
				),
				'livejournal' => array(
					'class' => 'LJOpenIDService',
				),
				/*'mailru' => array(
					// регистрация приложения: http://api.mail.ru/sites/my/add
					'class' => 'MailruOAuthService',
					'client_id' => '',
					'client_secret' => '',
				),*/
				'moikrug' => array(
					// регистрация приложения: https://oauth.yandex.ru/client/my
					'class' => 'MoikrugOAuthService',
					'client_id' => '...',
					'client_secret' => '...',
				),
				'odnoklassniki' => array(
					// регистрация приложения: http://www.odnoklassniki.ru/dk?st.cmd=appsInfoMyDevList&st._aid=Apps_Info_MyDev
					'class' => 'OdnoklassnikiOAuthService',
					'client_id' => '...',
					'client_public' => '...',
					'client_secret' => '...',
					'title' => 'Однокл.',
				),
			);


$params=array(
	// this is used in contact page
	'adminEmail'=>'info@ukryama.com',
   'imagePath'=>'/upload/st1234/',   
		//'layout'=>'startpage',
        // Add own start-points for Google-map (addHole contr)
        'latitude'=>'50.4639147',
        'longitude'=>'30.4707367',
);
