<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'type-rel-typerel-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
));
foreach($authtype as $atype){
	$atypelist[$atype['id']]=$atype['type'];
}
foreach($holetype as $htype){
	$htypelist[$htype['id']]=$htype['name'];
}
?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ht_id'); ?>
		<?php echo $form->dropDownList($model,'ht_id',$htypelist); ?>
		<?php echo $form->error($model,'ht_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'at_id'); ?>
		<?php echo $form->dropDownList($model,'at_id',$atypelist); ?>
		<?php echo $form->error($model,'at_id'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<table>
<?php
foreach($model->findAll() as $trel):
?>
	<tr><td><?= $trel->htype['name'] ?></td><td><?= $trel->atype['type'] ?></td></tr>
<?php endforeach; ?>
</table>
