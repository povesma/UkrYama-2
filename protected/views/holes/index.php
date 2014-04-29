<?php


if(Yii::app()->user->isModer)
	Yii::app()->clientScript->registerScript('modering',<<<EOD
    
    var bAjaxInProgress = false;	
	function ShowDelForm(obj, id)
	{
		var delform = document.getElementById('delform');
		if(delform)
		{
			$(delform).css('top', $(obj).offset().top);
			$(delform).css('left', $(obj).offset().left - 50);
			document.getElementById('del_id_input').value = parseInt(id);
			$(delform).fadeIn();
		}
	}
	function setPM_OK(id)
	{	
		if(bAjaxInProgress)
		{
			return false;
		}		
		bAjaxInProgress = true;
		jQuery.get
		(
			'/holes/moderate/',
			{
				id: parseInt(id),
				ajax: 1,
			},
			function(data)
			{
				bAjaxInProgress = false;
				if(data == 'ok')
				{
					$('#premoderate_' + id).fadeOut();
				}
			}
		);
	}

EOD
,CClientScript::POS_HEAD);
	?>
	
<?php
if(Yii::app()->user->isModer && $model->NOT_PREMODERATED){
$all_elements=implode(',',$dataProvider->keys);
	Yii::app()->clientScript->registerScript('mass_modering',<<<EOD
    
    var bAjaxInProgress2 = false
	function set_all_right()
	{	
		if(bAjaxInProgress2)
		{
			return false
		}
		bAjaxInProgress2 = true
		jQuery.get
		(
			'/holes/moderate/',
			{
				id : 0,
				PREMODERATE_ALL: '{$all_elements}',
				ajax: 1, 
			},
			function(data)
			{
				bAjaxInProgress2 = false
				if(data == 'ok')
				{
					id = new Array({$all_elements})
					for(var key in id)
					{
						$('#premoderate_' + id[key]).fadeOut()
					}
				}
			}
		)
	}
	
	function delete_all()
	{
	
		jQuery.post
		(
			'/holes/delete/',
			{
				DELETE_ALL: '{$all_elements}',
				ajax: 1,
			},
			function(data)
			{
				if(data == 'ok'){
					window.location.reload();
				}
			}
		)
	}
	
	
	$(document).ready(function()
	{
		$('#all_right').click(
			function(){
				set_all_right()
			}
		)
		
		$('#all_wrong').click(
			function(){
				if(confirm("Удалить все дефекты на текущей странице?")){
					delete_all()
				}
			}
		)
	})

EOD
,CClientScript::POS_HEAD);
}	
	?>
	
<div id="delform">
	<div align="right"><span onclick="$('#delform').fadeOut()">&times;</span></div>
	<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl("holes/delete"),		
	)); ?>
		<input type="hidden" name="id" id="del_id_input">
		<input type="hidden" name="returnUrl" value="/" />
		<input type="checkbox" name="banuser" value="1" id="banuser_input"> <label for="banuser_input">Забанить автора?</label><br>
		<input type="submit" value="Удалить">
	<?php $this->endWidget(); ?>
</div>

<div class="lCol">



<?php $this->widget('application.widgets.news.newsWidget'); ?>
<?php $this->widget('application.widgets.social.socialWidget'); ?>

</div>

<div class="rCol">

	<div class="filter clearfix">
		<?php
		$form=$this->beginWidget('CActiveForm', array(
		//'action'=>Yii::app()->createUrl("departure/out"),
		'method'=>'get',
		'id'=>'filter_form',
		'htmlOptions'=>array()
		)); ?>
		<p class="long">
			<label class="fc">Область</label>
			<?php

 $this->widget('EJuiAutoCompleteFkField', array(
      'model'=>$model, 
      'attribute'=>'region_id', //the FK field (from CJuiInputWidget)
      // controller method to return the autoComplete data (from CJuiAutoComplete)
      'sourceUrl'=>Yii::app()->createUrl('/holes/findRegion'), 
      // defaults to false.  set 'true' to display the FK field with 'readonly' attribute.
      'showFKField'=>false,
       // display size of the FK field.  only matters if not hidden.  defaults to 10
      'FKFieldSize'=>15, 
      'relName'=>'subject', // the relation name defined above
      'displayAttr'=>'name',  // attribute or pseudo-attribute to display
      // length of the AutoComplete/display field, defaults to 50  
      'autoCompleteLength'=>60,
      // any attributes of CJuiAutoComplete and jQuery JUI AutoComplete widget may 
      // also be defined.  read the code and docs for all options
//      'cssClass'=>$model->region_id ? '' : 'disabled',
      'cssClass'=>'disabled',
      
      //'scriptFile'=>'jquery.autocomplete.js',      
      'options'=>array(
          // number of characters that must be typed before 
          // autoCompleter returns a value, defaults to 2
          'minLength'=>1,
          
      ),
 ));

 ?>
			
			</p>
			<div id="filter_rf_subject_tip" class="filter_roller"></div>
			<p class="short">
				<label><?php echo Yii::t("holes", "WIDGET_TYPE_DEFECT"); ?></label>
			<?php echo $form->dropDownList($model, 'TYPE_ID', HoleTypes::getList(), array('prompt'=>Yii::t("holes", "WIDGET_TYPE_DEFECT"))); ?>
			</p>
			<p class="long">
				<label class="fc"><?php echo Yii::t('holes', "WIDGET_DEFAULT_CITY");?></label>
			<?php
			$defval= Yii::t('holes', "WIDGET_DEFAULT_CITY");
			if ($model->ADR_CITY) $val=$model->ADR_CITY;
			else $val= $defval;
			$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model'=>$model,
				'attribute'=>'ADR_CITY',
				'source'=>'js:function(request, response){
						$.get("'.Yii::app()->createUrl('/holes/findCity').'?"+jQuery("#filter_form").serialize(), {data:""}, function(data){     
						  response($.map(data, function(item) {
						  return {
							label: item.label,
							value: item.value
						  }
						  }))
						}, "json");
					  }',					  
				// additional javascript options for the autocomplete plugin
				'options'=>array(
					'minLength'=>'1',
				),
				'htmlOptions'=>array(
					'class'=>$model->ADR_CITY ? '' : 'disabled',
					
				),
			));
			?>
					
			</p>
			<div id="filter_city_tip" class="filter_roller"></div>
			
			<p class="short">
				<label><?php echo Yii::t("holes", "WIDGET_STATUS_DEFECT"); ?></label>
			<?php echo $form->dropDownList($model, 'STATE', $model->Allstates, array('prompt'=>Yii::t("holes", "WIDGET_STATUS_DEFECT"))); ?>
			</p>
			<?php if(Yii::app()->user->isModer) : ?>
				<p>
				<?php echo $form->labelEx($model,'NOT_PREMODERATED'); ?>
				<?php echo $form->checkBox($model,"NOT_PREMODERATED",Array('class'=>'filter_checkbox')); ?>
				</p>
			<?php endif; ?>
			<span class="filterBtn" onclick="$(this).parents('form').submit();">
				<i class="text"><?php echo(Yii::t("holes", "WIDGET_SUBMIT_DEFECT"))?></i>
				<i class="arrow"></i>
			</span>
			<br>
			<?php 
			if(!$model->isEmptyAttribs): ?><span class="reset" onclick="document.location='/';"><?php echo(Yii::t("holes", "WIDGET_CLEAR_DEFECT"))?></span><?php endif; ?>
		<?php $this->endWidget(); ?>
</div>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'itemsTagName'=>'ul',
		'cssFile'=>Yii::app()->request->baseUrl.'/css/holes_list.css',
		'itemsCssClass'=>'holes_list',
		'summaryText'=>false,
		'viewData'=>Array('user'=>Yii::app()->user),
)); ?>
<?php if (Yii::app()->user->isModer && $model->NOT_PREMODERATED && $dataProvider->totalItemCount > 0) : ?>
	<input type="button" id="all_right" value="Разрешить все дефекты" />
	<input type="button" id="all_wrong" value="Удалить все дефекты" />
<?php endif; ?>
</div>
