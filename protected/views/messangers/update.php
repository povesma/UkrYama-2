<?php
/* @var $this MessengersController */
/* @var $model Messengers */

$this->breadcrumbs=array(
	'Messengers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Messengers', 'url'=>array('index')),
	array('label'=>'Create Messengers', 'url'=>array('create')),
	array('label'=>'View Messengers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Messengers', 'url'=>array('admin')),
);
?>

<h1>Update Messengers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>