<?php
/**
 * ECommentsLastListWidget class file.
 *
 * @author sander <kochetkov87@gmail.com>
 */

/**
 * Widget for view last comments for current model
 *
 * @version 1.0
 * @package Comments module
 */
Yii::import('comments.widgets.ECommentsBaseWidget');
class ECommentsLastListWidget extends ECommentsBaseWidget
{       
        /**
         * @var integer showCountRecords
         */
        public $showCountRecords = 10;
        
        /**
         * @var integer textLength
         */
        public $textLength = 100;
        
        /**
         * Initializes the widget.
         */
        public function init() 
        {
            
        }
        
	public function run()
	{
            $criteria = new CDbCriteria;
            $criteria->limit = $this->showCountRecords;
            $criteria->order = 'create_time DESC';
            //if premoderation is seted and current user isn't superuser
            if($this->_config['premoderate'] === true && $this->evaluateExpression($this->_config['isSuperuser']) === false) $criteria->compare('t.status', Comment::STATUS_APPROVED);
            else {
                $criteria->compare('t.status', Comment::STATUS_APPROVED);
                $criteria->compare('t.status', Comment::STATUS_NOT_APPROVED, true, 'OR');
            }
            $relations = Comment::relations();
            //if User model has been configured
            if(isset($relations['user'])) $criteria->with = 'user';
            $comments = Comment::model()->findAll($criteria);
            
            $this->render('ECommentsLastListWidget', array(
                'comments' => $comments,
                'textLength' => $this->textLength,
            ));
            
	}
}
?>
