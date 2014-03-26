<?
$this->pageTitle=Yii::app()->name.' :: '.Yii::t('template', 'EDIT_DEFECT');
?>
<?php echo $this->renderPartial('holeform', array('model'=>$model, 'newimage'=>new PictureFiles)); ?>
