<?php
class help {

	public $name 	= 'help';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Shows a list of available commands.';
	
	public function handle ($recv, $replyobj) {
		$helptxt = implode(", ", array_keys($replyobj->commands));
		$replyobj->reply('mltxt',"Available commands:\n\n".$helptxt."\n\nAdditional commands may be available depending on context.");
	}
	
}

$this->registerModule('help');
$this->registerCommand('help','help');
?>
