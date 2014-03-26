<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'auth-rel-authrel-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
));
foreach($auth as $head){
	$authlist[$head['id']]=$head['name'];
}
?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id1'); ?>
		<?php echo $form->dropDownList($model,'id1',$authlist); ?>
		<?php echo $form->error($model,'id1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'id2'); ?>
		<?php echo $form->dropDownList($model,'id2',$authlist); ?>
		<?php echo $form->error($model,'id2'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<table>
<?php
foreach($model->findAll() as $arel):
?>
	<tr><td><?= $arel->parent_authority['name'] ?></td><td><?= $arel->child_authority['name'] ?></td></tr>
<?php endforeach; ?>
</table>
