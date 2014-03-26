<?php
class Kyiv extends CWidget
{
	private $assetsDir;

	public function init(){
		Yii::Import('application.widgets.kyiv.models.*');

        	$dir = dirname(__FILE__) . '/assets';
	        $this->assetsDir = Yii::app()->assetManager->publish($dir);
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->assetsDir . '/js/bootstrap.min.js');
		$cs->registerScriptFile($this->assetsDir . '/js/jquery.min.js');
		$cs->registerScriptFile($this->assetsDir . '/js/jquery-ui.min.js');
		$cs->registerCssFile($this->assetsDir . '/css/bootstrap.css');
	        $this->assetsDir = Yii::app()->assetManager->publish($dir);

		$events = new Event;
		$events = $events->findAll();
		$gr = new EventTree;
		$tree = $gr->findAll("lang=:lang",array(":lang"=>"ua"));
		$this->render('main', array('tree'=>$tree, 'events'=>$events));
	}
}
?>
