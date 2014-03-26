<?php
$yii=dirname(__FILE__).'/../yii-last/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);
Yii::createWebApplication($config)->run();
