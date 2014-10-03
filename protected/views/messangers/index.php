<?php
/* @var $this MessangersController */
/* @var $model Messangers */


?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'messangers-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'user',
		'messanger',
		'uin',
		'status',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
