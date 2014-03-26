<?php
$this->title = Yii::t('holes_view', 'SET_DEFECT_AS_FIXED');
$this->pageTitle=Yii::app()->name . ' :: '.$this->title;
?>
<h1><?php echo $this->title; ?></h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'holes-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>Array ('enctype'=>'multipart/form-data'),
)); ?>
<?php echo $form->errorSummary($model); ?>
<?php echo $form->errorSummary($fixmodel); ?>

	<!-- левая колоночка -->
	<div class="lCol main_section">
		<!-- тип дефекта -->
		<div class="f">
			<p class="type <?= $model->type->alias ?>" style="padding-left: 30px;"><?= $model->type->getName()?></p>
         <p class="address"><?= CHtml::encode($model->ADDRESS) ?></p>
		</div>
		
		<!-- Дата исправления -->
		<div class="f clearfix">
		<?php echo $form->labelEx($fixmodel,'date_fix'); ?>
      <?php echo CHtml::textField('fixdate', date(C_DATEFORMAT, $fixmodel->date_fix)); ?>
		<?php echo $form->error($fixmodel,'date_fix'); ?>
		</div>
      <script> $('#fixdate').datepicker({dateFormat: '<?php  echo C_DATEFORMAT_JS ?>'});</script>
            
		<!-- фотки -->
		<div class="f clearfix">
			<?php echo $form->labelEx($model,'upploadedPictures'); ?>
			<?php $this->widget('CMultiFileUpload',array('accept'=>'gif|jpg|png|pdf|txt', 'model'=>$model, 'attribute'=>'upploadedPictures', 'htmlOptions'=>array('class'=>'mf'), 'denied'=>Yii::t('mf','Невозможно загрузить этот файл'),'duplicate'=>Yii::t('mf','Файл уже существует'),'remove'=>Yii::t('mf','удалить'),'selected'=>Yii::t('mf','Файлы: $file'),)); ?>						
		</div>
		
		<!-- камент -->
		<div class="f clearfix">
			<?php echo $model->COMMENT1; ?>
		</div>

	<div class="f">		
		<div class="bx-yandex-view-layout wide">
			<div class="bx-yandex-view-map">
			<div id="ymapcontainer" class="ymapcontainer"></div>
			<?php Yii::app()->clientScript->registerScript('initmap',<<<EOD
				var map = new YMaps.Map(YMaps.jQuery("#ymapcontainer")[0]);
				map.enableScrollZoom();
				map.setCenter(new YMaps.GeoPoint({$model->LONGITUDE},{$model->LATITUDE}), 14);
				var placemark = new YMaps.Placemark(new YMaps.GeoPoint({$model->LONGITUDE},{$model->LATITUDE}), { hideIcon: false, hasBalloon: false });
				map.addOverlay(placemark);
EOD
,CClientScript::POS_READY);
?>
			</div>
		</div>
		<img src="/images/map_shadow.jpg" class="mapShadow" alt="" />

	</div>		
		
		<!-- камент -->
		<div class="f">
			<?php echo $form->labelEx($model,'COMMENT2'); ?>
			<?php echo $form->textArea($model,'COMMENT2',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'COMMENT2'); ?>
		</div>

	</div>
	<!-- /правая колоночка -->
	<div class="addSubmit">
		<div class="container">
			<div onclick="$(this).parents('form').submit();">
				<a class="addFact"><i class="text"><?php echo Yii::t('template', 'SEND')?></i><i class="arrow"></i></a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->
