<?php
$this->pageTitle=Yii::app()->name.' :: '.Yii::t('template', 'ADDING_DEFECT');
?>

<h1><a><?php echo Yii::t('template', 'ADDING_DEFECT') ?></a></h1>			
<?php echo $this->renderPartial('_form', array('model'=>$model, 'newimage'=>new PictureFiles)); ?>


