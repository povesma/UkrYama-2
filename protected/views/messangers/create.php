<?php
/* @var $this MessangersController */
/* @var $model Messangers */

$this->breadcrumbs=array(
	'Messangers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Messangers', 'url'=>array('index')),
	array('label'=>'Manage Messangers', 'url'=>array('admin')),
);
?>

<h1>Create Messangers</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>