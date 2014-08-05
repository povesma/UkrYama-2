<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Payments', 'url'=>array('index')),
	array('label'=>'Manage Payments', 'url'=>array('admin')),
);
?>

<h1>Create Payments</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>