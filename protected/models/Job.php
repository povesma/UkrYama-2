<?php
/*
CREATE TABLE `yii_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `params` varchar(10000) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
)
*/
class Job extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function relations(){
		return array(
		);
	}
 
	public function tableName()
	{
		return '{{job}}';
	}
}
?>
