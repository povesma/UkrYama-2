<?php
class EventType extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		'eventtype'=>array(self::BELONGS_TO, 'Event', 'event'),
		);
	}
	public function tableName()
	{
		return '{{event_type}}';
	}
}
?>
