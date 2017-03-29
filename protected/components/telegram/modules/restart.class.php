<?php
class restart {

	public $name 	= 'restart';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Restarts the bot.';
	
	public function handle ($recv, $replyobj) {
		$replyobj->reply('txt','Will do.');
		die("Restart requested.\n");
	}
	
}

$this->registerModule('restart');
$this->registerCommand('restart','restart');
?>