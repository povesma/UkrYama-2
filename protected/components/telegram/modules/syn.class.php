<?php
class synack {

	public $name 	= 'synack';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Replies -ack- on call.';
	
	public function handle ($recv, $replyobj) {
		$replyobj->reply('txt','ack');
	}
	
}

$this->registerModule('synack');
$this->registerCommand('syn','synack');
?>
