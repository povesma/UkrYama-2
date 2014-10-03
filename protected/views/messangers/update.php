<?php
/* @var $this MessangersController */
/* @var $model Messangers */

$this->breadcrumbs=array(
	'Messangers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Messangers', 'url'=>array('index')),
	array('label'=>'Create Messangers', 'url'=>array('create')),
	array('label'=>'View Messangers', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Messangers', 'url'=>array('admin')),
);
?>

<h1>Update Messangers <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>