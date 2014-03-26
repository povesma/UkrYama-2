<?php
class EventTree extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return '{{event_tree}}';
    }
}
?>
