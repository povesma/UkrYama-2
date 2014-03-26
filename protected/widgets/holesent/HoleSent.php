<?php
class HoleSent extends CWidget
{
	public $hole;
	public $req;
	public function init(){
		if(Yii::app()->getLanguage()=="ru"){
			$this->render('main', array('hole'=>$this->hole,'req'=>$this->req));
		}else{
			$this->render('main_ukr', array('hole'=>$this->hole,'req'=>$this->req));
		}
	}
}
?>
