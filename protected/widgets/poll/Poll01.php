<?php
class Poll01 extends CWidget
{
	private $assetsDir;

	public function init(){
        	$dir = dirname(__FILE__) . '/assets';
	        $this->assetsDir = Yii::app()->assetManager->publish($dir);
		$cs = Yii::app()->getClientScript();
		$cs->registerScriptFile($this->assetsDir . '/js/bootstrap.min.js');
		$cs->registerScriptFile($this->assetsDir . '/js/jquery.min.js');
		$cs->registerScriptFile($this->assetsDir . '/js/jquery-ui.min.js');
		$cs->registerCssFile($this->assetsDir . '/css/bootstrap.css');
	        $this->assetsDir = Yii::app()->assetManager->publish($dir);
		if(Yii::app()->getLanguage()=="ru"){
			$this->render('main');
		}else{
			$this->render('main_ukr');
		}
	}
}
?>
