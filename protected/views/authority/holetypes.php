<?php
/* @var $this HoleTypesController */
/* @var $model HoleTypes */
/* @var $form CActiveForm */
?>
<style>
.holetypes-form{
	display:none;
}
</style>
<script>
function edit(rec){
	$(".holetypes-form").css('display','inline');

	var record = $("#rec_"+rec);
	var id = record.find(".id").text();
	var lang = record.find(".lang").text();
	var alias = record.find(".alias").text();
	var name = record.find(".name").text();
	var published = record.find(".status").text();

	HoleTypes_id.value=id;
	HoleTypes_lang.value=lang;
	HoleTypes_alias.value=alias;
	HoleTypes_name.value=name;
	HoleTypes_published.value=published;

	HoleTypes_id.disabled=false;
	HoleTypes_lang.disabled=false;
	HoleTypes_alias.disabled=false;
	HoleTypes_name.disabled=false;
	HoleTypes_published.disabled=false;

	subBtn.value="Edit";
}
function dele(rec){
	$(".holetypes-form").css('display','inline');

	var record = $("#rec_"+rec);
	var id = record.find(".id").text();
	var lang = record.find(".lang").text();
	var alias = record.find(".alias").text();
	var name = record.find(".name").text();
	var published = record.find(".status").text();

	HoleTypes_id.value=id;
	HoleTypes_lang.value=lang;
	HoleTypes_alias.value=alias;
	HoleTypes_name.value=name;
	HoleTypes_published.value=published;
/*
	HoleTypes_id.disabled=true;
	HoleTypes_lang.disabled=true;
	HoleTypes_alias.disabled=true;
	HoleTypes_name.disabled=true;
	HoleTypes_published.disabled=true;
*/
	subBtn.value="Delete";
}
function add(){
	$(".holetypes-form").css('display','inline');
	HoleTypes_id.value="";
	HoleTypes_lang.value="";
	HoleTypes_alias.value="";
	HoleTypes_name.value="";
	HoleTypes_published.value=0;

	HoleTypes_id.disabled=false;
	HoleTypes_lang.disabled=false;
	HoleTypes_alias.disabled=false;
	HoleTypes_name.disabled=false;
	HoleTypes_published.disabled=false;

	subBtn.value="Add";
}
</script>
<p class="err required"><?= $err ?></p>
<div><input type="image" src="/images/add-icon-24x24.png" onClick="add()"></div>
<div class="form holetypes-form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hole-types-holetypes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lang'); ?>
		<?php echo $form->textField($model,'lang'); ?>
		<?php echo $form->error($model,'lang'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alias'); ?>
		<?php echo $form->textField($model,'alias'); ?>
		<?php echo $form->error($model,'alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'published'); ?>
		<?php echo $form->textField($model,'published'); ?>
		<?php echo $form->error($model,'published'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('',array('id'=>'subBtn','name'=>'subBtn')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<table>
<?php
	$i=1;
	$htypes = $model->findAll();
	foreach($htypes as $type){
		echo "<tr id='rec_".$i."'><td><div class='id'>".$type['id']."</div></td><td><div class='lang'>".$type['lang']."</div></td><td><div class='alias'>".$type['alias']."</div></td><td><div class='name'>".$type['name']."</div></td><td><div class='status'>".$type['published']."</div></td><td><input type=\"image\" src=\"/images/edit-icon.png\" onClick='edit(".$i.")'> <input type=\"image\" src=\"/images/delete-icon.png\" onClick='dele(".$i.")'></td></tr>";
		$i++;
	}
?>
</table>
