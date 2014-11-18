<?php
/* @var $this MessengersController */
/* @var $model Messengers */

$this->breadcrumbs=array(
	'Messengers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Messengers', 'url'=>array('index')),
	array('label'=>'Manage Messengers', 'url'=>array('admin')),
);
?>

<h1>Create Messengers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>