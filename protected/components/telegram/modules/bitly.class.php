<?php
class bitly {

	public $name 	= 'bitly';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Shortens supplied URL using bit.ly.';
	
	public function handle ($recv, $replyobj) {
	
		if(file_exists('config/bitly.php')) {
				include('config/bitly.php');
		} else {
				$replyobj->reply('txt','You need to supply a bit.ly API key in the config file.');
		}
		
		array_shift($recv);
		$recv = implode(" ", $recv);
		
		# Thanks to @darkwing on GitHub for the code!
		# http://davidwalsh.name/bitly-api-php
		
		$connectURL = 'http://api.bit.ly/v3/shorten?login='.$bitly_username.'&apiKey='.$bitly_apikey.'&uri='.urlencode($recv).'&format=txt';

		$replyobj->reply('txt',$this->curl_get_result($connectURL));
	}
	
	private function curl_get_result($url) {
		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}	
}

$this->registerModule('bitly');
$this->registerCommand('shorturl','bitly');
?>