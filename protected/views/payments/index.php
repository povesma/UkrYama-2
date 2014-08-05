<?php
/* @var $this PaymentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Payments',
);

$this->menu=array(
	array('label'=>'Create Payments', 'url'=>array('create')),
	array('label'=>'Manage Payments', 'url'=>array('admin')),
);
?>

<h1>Payments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
