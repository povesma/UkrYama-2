<?php
class lastfm {

	public $name 	= 'lastfm';
	public $version = '0.02';
	public $creator = 'kenny';
	public $desc	= 'Tells you what a lastfm account is currently listening to.';
	
	public function handle ($recv, $replyobj) {
		// Thanks to @philipnorton42 for the code
		$scrobbler_url = "http://ws.audioscrobbler.com/2.0/user/" . $recv[1] . "/recenttracks";
		if ($scrobbler_xml = file_get_contents($scrobbler_url)) {
	        $scrobbler_data = simplexml_load_string($scrobbler_xml);        
	        //$replyobj->reply('txt',$recv[1] . ' most recently listened to '. $scrobbler_data->track[0]->name .' by '. $scrobbler_data->track[0]->artist .'.');
	        $replyobj->reply('mltxt',$recv[1] . " most recently listened to:\n". $scrobbler_data->track[0]->artist ." - ". $scrobbler_data->track[0]->name);
		} else {
			$replyobj->reply('txt',"Sorry, this user doesn't exist or hasn't listened to any music yet.");
		}
		
	}
	
}

$this->registerModule('lastfm');
$this->registerCommand('lastfm','lastfm');
?>