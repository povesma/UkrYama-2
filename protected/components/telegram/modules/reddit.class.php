<?php
class reddit {

	public $name 	= 'reddit';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Sends you a random image from a subreddit.';
	
	public function handle ($recv, $replyobj) {
		if(empty($recv[1])) {
			$replyobj->reply('txt',"You didn't tell me a subreddit.");	
			return;	
		}
	
		$replyobj->reply('txt','Crawling /r/'.$recv[1].' ...');

		// Download list of images
		// Thanks to @flotwig on GitHub - https://gist.github.com/flotwig/3845707
		$ch = curl_init('http://www.reddit.com/r/' . $recv[1] . '.json');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_USERAGENT,'/u/datkenny'); // for stats
		$result = curl_exec($ch);
		
		// Decode JSON result
		$result = json_decode($result,TRUE);
		curl_close($ch);
		
		// Consolidate links into one array
		$run = 0;
		foreach($result['data']['children'] as $thisResult) {
			if(!empty($thisResult['data']['url'])) {
				$run++;
				$links[$run] = $thisResult['data']['url'];
			}
		}
		
		// Remove all links that aren't imgur
		$links = array_filter($links, function($var){
			return (strpos($var,'i.imgur.com/'));
		});
			
		// Restore key order in Array	
		$links = array_values($links);
		
		// Check if an image was found, and if so, upload it.
		$imageurl = $links[rand(0,max(array_keys($links)))];
		if(!empty($imageurl)) {
				$replyobj->reply('txt',"Found ".max(array_keys($links))." images on page 1, uploading one of them ... ( ".$imageurl." )");
				$replyobj->reply('imgget',$imageurl);
		} else {
				$replyobj->reply('txt',"Sorry, /r/".$recv[1]." doesn't exist or doesn't have any imgur links on it.");
		}
	}
}

$this->registerModule('reddit');
$this->registerCommand('reddit','reddit');

?>