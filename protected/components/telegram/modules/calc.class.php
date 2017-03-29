<?php
class calc {

	public $name 	= 'calc';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Calculates a supplied string.';
	
	public function handle ($recv, $replyobj) {
		//array_shift($recv);
		$string = trim(implode(" ",$recv));
		$string = preg_replace('/[^0-9\+\-\*\/\(\) ]/i', '', $string);
		$compute = create_function('', 'return (' . $string . ');' );
		$replyobj->reply('txt', 0 + $compute());
	}
	
}

$this->registerModule('calc');
$this->registerCommand('calc','calc');
?>