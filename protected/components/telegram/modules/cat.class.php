<?php
class cat {

	public $name 	= 'cat';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Answer is cat.';
	
	public function handle ($recv, $replyobj) {
		$replyobj->reply('txt','Answer is cat!');
		if(isset($recv[1])) {
			$splod = explode("x",$recv[1]);
			$replyobj->reply('imgget','http://placekitten.com/g/'.$splod[0].'/'.$splod[1]);	
			return;		
		}
		$replyobj->reply('imgget','http://thecatapi.com/api/images/get');
	}
	
}

$this->registerModule('cat');
$this->registerCommand('cat','cat');
$this->registerCommand('cate','cat');
?>
