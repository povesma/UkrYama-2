<?php
class dogrio {

	public $name 	= 'dogrio';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Answer is cat.';
	
	public function handle ($recv, $replyobj) {
		array_shift($recv);
		$mesg = implode(' ',$recv);
		
		$replyobj->reply('txt','Answer is doge!');
		$replyobj->reply('imgget','http://dogr.io/'. $mesg . '.png');
	}
	
}

$this->registerModule('dogrio');
$this->registerCommand('dogify','dogrio');
?>
