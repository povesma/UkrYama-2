<?php
class ecko {

	public $name 	= 'ecko';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Shits everything you say right back at you.';
	
	public function handle ($recv, $replyobj) {
		array_shift($recv);
		$recv = implode(" ", $recv);
		$replyobj->reply('txt',$recv);
	}
	
}

$this->registerModule('ecko');
$this->registerCommand('ecko','ecko');
?>