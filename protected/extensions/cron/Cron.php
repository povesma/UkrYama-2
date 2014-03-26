<?php
/*
Class Cron by Lord_Evil(c)2013
Used to run jobs at certain times when user hits pages
To work needs a table in current database:

CREATE TABLE `yii_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `params` varchar(10000) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
)

Usage:
	$a = new Cron;
	$a->run();
New Mail Job:
	$a->addJob("mail","2013-07-16 18:02:24",array("var1"=>"test subject","var2"=>"test body","var3"=>"sex@yahoo.com","var4"=>"admin@vokne.org"));
New Close Order Job:
	$a->addJob("closeOrder","2013-07-17 18:02:24",array("var1"=>"115"));
*/
class Cron
{
	private $todolist;
	private $timer =360;//seconds between runs

	private function checkJobs(){
		$job = new Job;
//		$sql = "SELECT * FROM jobs WHERE type!='time' and datetime<'".date("Y-m-d H:i:s")."'";
		$this->todolist=$job->findAll("type!='time' and datetime<:datetime",array('datetime'=>date("Y-m-d H:i:s")));
		return count($this->todolist);
	}
	private function runJobs(){
		foreach($this->todolist as $job){
			switch ($job['type'])
			{
				case "mail":
						if(is_null($job['var4']) or is_null($job['var3'])) break;
						//to|subject|message|additional headers("From" in our case)
					mail($job['var4'],$job['var1'],$job['var3'],"From: ".$job['var4']);
				break;
			}
		}
	}
	private function purgeJobs(){
		foreach($this->todolist as $job){
			$list[]=$job['id'];
		}
//		 $sql ="DELETE FROM jobs WHERE id IN(".implode(", ",$list).")";
//		 Yii::app()->db->createCommand($sql)->execute();
	}

	private function checkTime(){

//		$command = Yii::app()->db->createCommand("SELECT datetime FROM jobs WHERE type='time'")->queryRow();
		$time = strtotime ($command['datetime']);
		$time2 = strtotime (date("Y-m-d H:i:s"));
		if(60*60 < ($time2-$time)) {return 1;}
		else{
			return 0;
 		}
	}
	private function setTime(){
		$command = Yii::app()->db->createCommand();
		$command->update('jobs',array('datetime'=>date("Y-m-d H:i:s")), 'type=:type', array(':type'=>"time"));
		$command->reset();
		return 0;
	}

	public function run(){
		if($this->checkTime()){	//last time started, max run every hour
			if($this->checkJobs()>0){
				$this->runJobs();
				$this->purgeJobs();
				$this->setTime();//sets time when cron ran all jobs
			}
		}
	return;
	}
	public function addJob($type,$datetime,$argv){
		$vars="";
		$vals="";
		while ($var = current($argv)) {
			$vars.=",".key($argv);
			$vals.=",'".$var."'";
			next($argv);
		}
		$sql="INSERT INTO jobs(type,datetime$vars) VALUES('$type','$datetime'$vals)";
		$sql;
	}

}
?>
