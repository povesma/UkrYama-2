<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Payments', 'url'=>array('index')),
	array('label'=>'Create Payments', 'url'=>array('create')),
	array('label'=>'Update Payments', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Payments', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Payments', 'url'=>array('admin')),
);
?>

<h1>View Payments #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'hole_id',
		'amount',
		'date',
		'status',
		'type',
	),
)); ?>
