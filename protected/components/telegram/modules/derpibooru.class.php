<?php
class derpibooru {

	public $name 	= 'derpibooru';
	public $version = '0.01';
	public $creator = 'kenny';
	public $desc	= 'Sends you a random image from a tag on derpibooru.';
	
	public function handle ($recv, $replyobj) {
		if(empty($recv[1])) {
			$replyobj->reply('txt',"You didn't tell me any tags to search for.");	
			return;	
		}
		
		// Check if an API key has been provided.
		if(file_exists('config/derpibooru.php')) {
				include('config/derpibooru.php');
		}
	
		$replyobj->reply('txt','Crawling Derpibooru ...');

		// Download list of images
		// Thanks to @flotwig on GitHub - https://gist.github.com/flotwig/3845707
		array_shift($recv);
		$tags = implode(' ',$recv);
		if(isset($derpibooru_apikey)) {
			$ch = curl_init('https://derpibooru.org/search.json?key='.$derpibooru_apikey.'&q=' . $tags);
		} else {
			$ch = curl_init('https://derpibooru.org/search.json?q=' . $tags);
		}
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.143 Safari/537.36');
		$result = curl_exec($ch);
		
		// Decode JSON result
		$result = json_decode($result,TRUE);
		curl_close($ch);
		
		print_r($result);
		
		$run = 0;
		foreach($result['search'] as $thisResult) {
			if(!empty($thisResult['representations']['small'])) {
				$run++;
				$links[$run]['url'] = $thisResult['representations']['small'];
				$links[$run]['id'] = $thisResult['id'];
			}
		}
		
		// Restore key order in Array	
		$links = array_values($links);
		
		
		// Check if an image was found, and if so, upload it.
		$randno = rand(0,max(array_keys($links)));
		$imageurl = $links[$randno]['url'];
		$imageid = $links[$randno]['id'];
		if(!empty($imageurl)) {
				$replyobj->reply('txt',"Found ".max(array_keys($links))." images, uploading one of them ... ( http://derpiboo.ru/".$imageid." )");
				$replyobj->reply('imgget','http:'.$imageurl);
		} else {
				$replyobj->reply('txt',"Sorry, I couldn't find any images for your search.");
		}
		
		/*// Consolidate links into one array
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
		}*/
		
	}
}

$this->registerModule('derpibooru');
$this->registerCommand('dbooru','derpibooru');

?>