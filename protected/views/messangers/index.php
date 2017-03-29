<?php
/* @var $this MessengersController */
/* @var $model Messengers */


?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messengers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user',
		'messenger',
		'uin',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
