<?php
class main {
	public $commands = array();
	public $modules = array();
	public $stringchecks = array();
	
	private $numModules = NULL;
	private $numCommands = NULL;
	
	public $lastSender = NULL;
	
	public function __construct() {
		//
	}
	
	// allows modules to register themselves
	public function registerModule ($module) {
		$this->numModules++;
		$this->modules[$this->numModules] = $module;
	}
	
	// allows modules to register new commands
	public function registerCommand ($cmd, $handler) {
		$this->commands[$cmd] = $handler;		
	}
	
	// alllows modules to receive the entire string should no registered command be able to use it
	public function registerStringCheck ($string, $handler) {
		$this->stringchecks[$string] = $handler;
	}

	// handle received commands
	public function handle ($recv) {
		//$pid = pcntl_fork();
		//if ($pid) {
		//	echo "I'm a parent!";
		//	return;
		//} else {
		//	echo "I'm a child!";
			$handler = @$this->commands[$recv[0]]; // find out handler for command
			print_r($recv);
			if(!empty($handler)) {
				$hdl = new $handler;
				$hdl->handle($recv,$this); // delegate handling to command
			} else {
				$handled = false;
				foreach($this->stringchecks as $string => $handler) {
					if(!empty($handler) && preg_match("/$string/i", implode(" ",$recv))) {
						$handled = true;
						$hdl = new $handler;
						$hdl->handleSC($recv,$this);
					}
				}
				if (!$handled) $this->reply('txt', "Sorry, I don't know this command.");
			}
			unset($hdl);
		//	die();
		//}
	}
	
	public function loadModules () {
		foreach (glob("modules/*.php") as $filename) {
			include $filename;
		}
	}
	
	public function getCmd () {
		redo:
		$request = shell_exec('expects/tgrecvmsg.xp | grep ">>>"');
		if(empty($request)) goto redo;
		$reqArray = explode(" ",$request);
	
//	    array_shift($reqArray);
	    array_shift($reqArray);
		array_shift($reqArray);
		array_shift($reqArray);
		
		$sender = NULL;
		
		$delimiter = array_search(">>>",$reqArray);
		
		while ($reqArray[0] != ">>>" OR empty($reqArray)) {
			if(!empty($sender)) $sender .= "_";
			$sender .= $reqArray[0];
			array_shift($reqArray);
		}
		
		array_shift($reqArray);
		
		$this->lastSender = $sender;
		$reqArray[max(array_keys($reqArray))] = preg_replace( "/\r|\n/", "", $reqArray[max(array_keys($reqArray))]);
				
		return $reqArray;
	}
	
	// send replies to sender
	public function reply ($type, $mesg) {
		switch ($type) {
			case 'imgstatic':  // Static image
				shell_exec('expects/tgsendimg.xp '.$this->lastSender.' '.$image);
				break;
				
			case 'imgget': // Image from URL
				shell_exec('wget --quiet -O /tmp/img.jpg '.$mesg);
				shell_exec('expects/tgsendimg.xp '.$this->lastSender.' /tmp/img.jpg');
				shell_exec('rm /tmp/img.jpg');
				break;
				
			case 'txt': // Standard message
				$mesg = preg_replace( "/\r|\n/", " ", $mesg);
				shell_exec('expects/tgsendmsg.xp '.$this->lastSender.' "'.$mesg.'"');
				break;
				
			case 'mltxt': // Standard message
				//$mesg = preg_replace( "/\r|\n/", " ", $mesg);
				file_put_contents("/tmp/mesg.txt", $mesg);
				shell_exec('expects/tgsendmsg_ml.xp '.$this->lastSender.' /tmp/mesg.txt');
				unlink("/tmp/mesg.txt");
				break;
				
			default:
				echo "Illegal.";
				break;
		}
	}
	
	// MySQL connection
	public function exeQ ($dbcon, $query, $qMap=NULL) {
			$qt = $dbcon->prepare($query);
			$qt->execute($qMap);
			$retval = $qt->fetchAll(PDO::FETCH_ASSOC);
			return $retval;
	}
	
}

$bot = new main();
$bot->loadModules();

//print_r($bot->commands);
//print_r($bot->modules);

// Main loop
while (1) {
	$recv = $bot->getCmd();
	$bot->handle($recv);
}

?>
