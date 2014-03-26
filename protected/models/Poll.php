<?php
class Poll extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function relations(){
		return array(
			'user'=>array(self::BELONGS_TO, 'UserGroupsUser', 'u_id'),
		);
	}
 
	public function tableName()
	{
		return '{{poll}}';
	}
}
?>
