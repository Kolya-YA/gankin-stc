<?php

Yii::setPathOfAlias('uploads',$_SERVER['DOCUMENT_ROOT'].'/media');

//$db_host = substr($_SERVER['HTTP_HOST'], -6, 6) == '.local' ? 'localhost' : '78.108.80.119';
$db_host = 'localhost';
//$db_host = stripos($_SERVER['HTTP_HOST'],'ocal') ? 'localhost' : '78.108.80.119';

return [
	'language' => 'en',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Surf-tarifa.com',

	// preloading 'log' component
	'preload'=> ['log'],

	// autoloading model and component classes
	'import'=> [
		'application.models.*',
		'application.components.*',
// 		'application.validators.MultilangValidator',
		'zii.widgets.CMenu',
    ],

	'modules'=> [
		// uncomment the following to enable the Gii tool
		'TranslatePhpMessage' => [
			'encoding' => 'UTF-8', //encoding used to save messages
			'excludedirs' => [], //directories to exclude
			'excludefiles' => [], //files to exclude
        ],
		'gii'=> [
			'class'=>'system.gii.GiiModule',
			'password'=>'cunt265',
			//'ipFilters'=>array('127.0.0.1','::1'),
        ],
    ],

	// application components
	'components'=> [
		'messages' => [
			'onMissingTranslation' => ['Lang', 'missingTranslation'],
			'class' => 'Messages',
        ],
		'user'=> [
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'class' => 'WebUser',

        ],
		'Paypal' => [
			'class'=>'application.components.Paypal',
			'apiUsername' => 'info_api1.surf-tarifa.com',
			'apiPassword' => 'B8Q3X8D9MUGCEUY6',
			'apiSignature' => 'AzNZ3MneSEj1NfPKf.9W8Sm-szt2A3GRJmYSBWGhUgymVIaJIMTGNMaF',
			'apiLive' => true,

// 			'apiUsername' => 'ahz265-facilitator_api1.gmail.com',
// 			'apiPassword' => '1374580520',
// 			'apiSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31A3pk4V1.Xds8PoJ3PKWFTnjtquCK',
// 			'apiLive' => false,
			'currency' => 'EUR',
			
			'returnUrl' => 'paypal/confirm/', //regardless of url management component
			'cancelUrl' => 'paypal/cancel/', //regardless of url management component
        ],
		'Posh' => [
			'payments' => 'cc,dd',
			'command' => 'authorization',
			'class'=>'application.components.Posh',
			'merchId' => '1584320404', //Production
			'secretKey' => 'GZlThQ35JF2LgrI-ftwAtnjDl', //Production
//			'merchId' => '9071150012', //Test
//			'secretKey' => 'SlBaxKxgIKMs2bXagUNFOhatc5b', //Test
			'returnUrl' => 'payment/success',
        ],
		
		'urlManager' => [
			'showScriptName' => false,
			'urlFormat' => 'path',
			'rules' => [
				'<action:(confirmation|login|logout|register|recover|recovery|userpanel|contacts)>' => 'site/<action>',

				'viewpage/<slug:[\w-]+>' => 'page/view',
				'<controller:\w+>/<id:\d+>' => '<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                'kite_schools_in_tarifa' => 'school/kite_schools_in_tarifa',
                'news' => 'news/NewsList',
				'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
// 				'page/<id:\d+>'=>'page/view',
                'equipment' => 'school/equipment',
				'<slug:(faq|tarifa|partner|rental|privacy|impressum)>' => 'page/view',
//				'contacts' => 'site/contact',
				'thumb/<filename:.+>[<w:\d+>*<h:\d+>].<ext:(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)>' => 'site/thumb',

//				'thumb/<filename:(.+)>\[<w:([0-9]+)>(x|X|\*)<h:([0-9]+)>\].<ext:(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)>' => 'site/thumb',
//              'thu66mb/<filename:(.+)>\[<w:([0-9]+)>(x|X|\*)(<h:[0-9]+)>\].<ext:(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)>' => 'site/thumb',
            ],
        ],
		
		'db' => [
			'connectionString' => "mysql:host=$db_host;dbname=b109820_surftarifacom",
			'emulatePrepare' => true,
			'username' => 'u109820',
			'password' => 'wwegsh_01',
			'charset' => 'utf8',
        ],

		'errorHandler' => [
			// use 'site/error' action to display errors
			'errorAction' => 'site/error',
        ],

		'log' => [
			'class' => 'CLogRouter',
			'routes' => [
				[
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
                ],

				// uncomment the following to show log messages on web pages
//                array(
//                    'class' => 'CWebLogRoute',
//                    'levels'=>'error, warning, trace, profile, info',
//                ),

            ],
        ],
    ],

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => [
		// this is used in contact page
		// 'adminEmail' => 'info@surf-tarifa.com',
		'adminEmail' => 'info@aquacream.ru',
    ],
];