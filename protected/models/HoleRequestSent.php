<?php
class HoleRequestSent extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function relations(){
		return array(
			'user'=>array(self::BELONGS_TO, 'Hole', 'hole_id'),
			'user'=>array(self::BELONGS_TO, 'UserGroupsUser', 'user_id'),
		);
	}
 
	public function tableName()
	{
		return '{{hole_request_sent}}';
	}
	public function updateMail(){
		$id=$this->rcpt;
		$http=new Http;
		$url="http://services.ukrposhta.com/barcodesingle/default.aspx?ctl00%24centerContent%24scriptManager=ctl00%24centerContent%24scriptManager%7Cctl00%24centerContent%24btnFindBarcodeInfo&__EVENTTARGET=&__EVENTARGUMENT=&ctl00%24centerContent%24txtBarcode=$id&__ASYNCPOST=true&ctl00%24centerContent%24btnFindBarcodeInfo=%D0%9F%D0%BE%D1%88%D1%83%D0%BA";
		$a= $http->http_request(array('url'=>$url,'return'=>'array', 'cookie'=>true));
		$cookie = $a['headers']['SET-COOKIE'];
		$url="http://services.ukrposhta.com/barcodesingle/DownloadInfo.aspx";
		$data= $http->http_request(array('url'=>$url, 'cookie'=>$cookie));
		
		$page=split("\n",$data);
		$print=0;
		foreach($page as $line){
			if($print){
				$result=strip_tags($line)."\n";
				$print=0;
			}
			if(strstr("$line","divInfo")){
				if(strstr("$line","</div>")){
					$result= strip_tags($line)."\n";
				}else{
					$print=1;
				}
			}
		}
		if(strstr($result,"вручене за довіреністю")){
			$this->ddate=date("Y-m-d",strtotime(mb_substr(strstr($result,"вручене за довіреністю "),23,10,'UTF-8')));
			$this->status=1;
			$this->update();
		}elseif(strstr($result,"вручене адресату (одержувачу) особисто")){
			$this->ddate=date("Y-m-d",strtotime(mb_substr(strstr($result,"особисто "),9,10,'UTF-8')));
			$this->status=1;
			$this->update();
		}else{

			return 0;
		}
	}	
}
?>
