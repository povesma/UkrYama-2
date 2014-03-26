<?php
/* @var $this HoleController */
/* @var $model Hole */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hole-hole-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); 
$regions=array();
foreach($region->children as $child){
	$ch=$child->children;
	$nodes=array();
	$nodes[$child['id']]=$child['name'];
	if(count($ch)){
		foreach($ch as $node){
			$nodes[$node["id"]]=$node['name'];
		}
	}
	$regions[$child["name"]]=$nodes;
}
foreach($holetype as $htype){
	$htypelist[$htype['id']]=$htype['name'];
}
?>

	<?php echo $form->errorSummary($model); ?>
	<?php $msg ?>
	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->dropDownList($model,'region',$regions); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'holetype'); ?>
		<?php echo $form->dropDownList($model,'holetype',$htypelist); ?>
		<?php echo $form->error($model,'holetype'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<p>
<?= $msg ?>
</p>
