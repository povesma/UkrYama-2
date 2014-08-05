<?php
/* @var $this PaymentsController */
/* @var $model Payments */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

/**
 * $this->menu=array(
 * 	array('label'=>'List Payments', 'url'=>array('index')),
 * 	array('label'=>'Create Payments', 'url'=>array('create')),
 * );
 */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#payments-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo Yii::t('template', 'PAYD')?></h1>

<?php echo CHtml::link('Пошук','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
            'date',
            //'hole_id',
            'description',
            'transaction_id',
            'amount',
            'status',
            'type',
    ),
)); ?>
