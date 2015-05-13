<?php
$bd=array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=ukryama_ukryama',
			'emulatePrepare' => false,
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
    //------------------------------------------------------------------------//
	    // payment notification email
	    'paymentEmail'=>'info@ukryama.com', 
    	    // Set the admin's and moder's messengers UINs.
   
            // Set the admin's messengers
    	    'adminEmail'=>'info@ukryama.com',
            'adminViber' => '',
            'adminVelegram' => '',
            'adminWhatsapp' => '',
            'adminFacebook' => '',
            'adminTwetter' => '',
            'adminInstagram' => '',
             
            // Activate the moderator role
            'enableModeratorRole' => false,
    
            // Set the moderator's messengers
            'moderatorEmail' => 'moder@ukryama.com',
            'moderatorViber' => '',
            'moderatorTelegram' => '',
            'moderatorWhatsapp' => '',
            'moderatorFacebook' => '',
            'moderatorTwetter' => '',
            'moderatorInstagram' => '',
    //------------------------------------------------------------------------//
            'imagePath'=>'/upload/st1234/',
                           
            // Add own start-points for Google-map (addHole contr)
            'latitude'=>'50.4639147',
            'longitude'=>'30.4707367',
            
    	    // Add a page name title (string)
 	    'langtitle' => 'УкрЯма - ',   
  	    'ukrautodorEmail' => 'povesma@gmail.com', // on live site should be ukryama@ukravtodor.gov.ua
            'saiEmail' => 'povesma@gmail.com', // on live site should be info@sai.gov.ua
            // These params used in paid-hole form (donate page)
            'public_key' => 'i8596801856', // LigPay public_pay param. You should get it on the LiqPay off-site https://www.liqpay.com/ru/admin/business/buttons
            'paymant_system' => 'LiqPay',
            'liqpay_sandbox'=>'1',
            'liqpay_server_url'=>'http://newtest.ukryama.com/payments/callback', // Change in producting server.
             
            // Current version
            'version' => '2.2',
    
            // Google Maps Geolocation API-Key
            'google_maps_api' => 'AIzaSyCTK4y073bUzvq0EGMPKskM57-3aN9JnsE', // Store here your own API-KEY. Get it on https://developers.google.com/maps/
            'google_maps_api_server' => 'AIzaSyCTK4y073bUzvq0EGMPKskM57-3aN9JnsE', // Server GoogleMap API-key
    
            // Messages configuration. Please, set state to TRUE if you want use same messenger in system.
            
            // Set core messengers state for
            'email' => false,
            'viber' => false,
            'telegram' => true,
            'whatsapp' => false,
            'facebook' => true,
            'twetter' => false,
            'instagram' => false,
    );