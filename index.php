<?php
defined('C_DATEFORMAT') or define('C_DATEFORMAT', 'd.m.Y');
defined('C_DATEFORMAT_JS') or define('C_DATEFORMAT_JS', 'dd.mm.yy');
defined('C_TIMEFORMAT') or define('C_TIMEFORMAT', 'h:m');

$yii=dirname(__FILE__).'/../yii-last/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
