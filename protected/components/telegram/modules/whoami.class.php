<?php
class whoami {

	public $name 	= 'whoami';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Tells you your username.';
	
	public function handle ($recv, $replyobj) {
		$replyobj->reply('txt','Your identifier is: '.$replyobj->lastSender);
	}
	
}

$this->registerModule('whoami');
$this->registerCommand('whoami','whoami');
?>
