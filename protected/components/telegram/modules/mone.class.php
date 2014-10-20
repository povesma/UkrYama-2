<?php
class mone {
	public $name 	= 'mone'; // these aren't needed, but it's probably good practice to have them
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Tracks money you spent and aims to allow you to view what you can still spend this month.';
	
	public function handle ($recv, $replyobj) {
	
			if(file_exists('config/dbconf.php')) {
				include('config/dbconf.php');
			} else {
				$replyobj->reply('txt','mone requires database access.');
			}
	
			//$replyobj->reply('txt',print_r($recv, true));
			
			switch ($recv[0]) {
				case 'm+': // User wants to add a new transaction in which he received money
					$replyobj->reply('txt','You received '. number_format($recv['1'] / 100, 2, '.', ' ') .' for '. $recv['2'] .' -  I saved that.');
					$rqMap = array(':value' => $recv['1'], ':desc' => $recv['2']);
					$replyobj->exeQ($mysql, "insert into `kybot`.`mone_transactions` ( `value`, `type`, `desc`) values ( :value, '1', :desc)", $rqMap);
					break;
				case 'm-': // User wants to add a new transaction in which he lost money
					$replyobj->reply('txt','You spent '. number_format($recv['1'] / 100, 2, '.', ' ') .' on '. $recv['2'] .' -  I saved that.');
					$rqMap = array(':value' => $recv['1'], ':desc' => $recv['2']);
					$replyobj->exeQ($mysql, "insert into `kybot`.`mone_transactions` ( `value`, `type`, `desc`) values ( :value, '0', :desc)", $rqMap);
					break;
				default:
					$replyobj->reply('txt','Help text here.');
					break;
			}
			
	}
	
}

$this->registerModule('mone');
$this->registerCommand('m+', 'mone');
$this->registerCommand('m-', 'mone');

?>
