<?php
class Event extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function relations(){
		return array(
			'type'=>array(self::HAS_MANY, 'EventType', 'event'),
			'media'=>array(self::HAS_MANY, 'EventMedia', 'e_id'),
			'user'=>array(self::BELONGS_TO, 'UserGroupsUser', 'u_id'),
		);
	}
 
	public function tableName()
	{
		return '{{event}}';
	}
}
?>
