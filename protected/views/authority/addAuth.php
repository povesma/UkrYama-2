<?php
/* @var $this EventController */

$this->breadcrumbs=array(
	'Add Authorities',
);
?>
<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'Authority',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'htmlOptions'=>array('name'=>'authority'),
));
$model=new Authority;
$typeList=array();
foreach($types as $type){
	$typeList[$type['id']]=$type['type'];
}
$regions=array();
$regions[$region["id"]]=$region['name'];
foreach($region->children as $child){
	$nodes=array();
	$nodes[$child['id']]=$child['name'];
	$ch=array();
	$ch=$child->children;
	if(count($ch)){
		foreach($ch as $node){
			$nodes[$node["id"]]=$node['name'];
		}
	}
		$regions[$child["name"]]=$nodes;
}
//print_r($regions);
?>
<table>
<tr>
    <td><?= $form->labelEx($model,'id'); ?></td>
    <td><?= $form->textField($model,'id'); ?></td>
    <?= $form->error($model,'id'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'lang'); ?></td>
    <td><?= $form->dropDownList($model,'lang',array("ru"=>"Rus","ua"=>"Ukr")); ?></td>
    <?= $form->error($model,'lang'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'type'); ?></td>
    <td><?= $form->dropDownList($model,'type',$typeList); ?></td>
    <?= $form->error($model,'type'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'region_id'); ?></td>
    <td><?= $form->dropDownList($model,'region_id', $regions); ?></td>
    <?= $form->error($model,'region_id'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'name'); ?></td>
    <td><?= $form->textField($model,'name'); ?></td>
    <?= $form->error($model,'name'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'address'); ?></td>
    <td><?= $form->textField($model,'address'); ?></td>
    <?= $form->error($model,'address'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'index'); ?></td>
    <td><?= $form->textField($model,'index'); ?></td>
    <?= $form->error($model,'index'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'o_name'); ?></td>
    <td><?= $form->textField($model,'o_name'); ?></td>
    <?= $form->error($model,'o_name'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'o_pos'); ?></td>
    <td><?= $form->textField($model,'o_pos'); ?></td>
    <?= $form->error($model,'o_pos'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'o_phone'); ?></td>
    <td><?= $form->textField($model,'o_phone'); ?></td>
    <?= $form->error($model,'o_phone'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'o_email'); ?></td>
    <td><?= $form->textField($model,'o_email'); ?></td>
    <?= $form->error($model,'o_email'); ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'o_fax'); ?></td>
    <td><?= $form->textField($model,'o_fax'); ?></td>
    <?= $form->error($model,'o_fax'); ?>
</tr>
<tr>
<td colspan=2><?php echo CHtml::submitButton("Add", Array('class'=>'submit')); ?></td>
</tr>
</table>

<?php $this->endWidget(); ?>
