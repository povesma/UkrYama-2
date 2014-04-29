<?php

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	//'method'=>'get',
	'id'=>'holes_selectors',
)); 	
		
echo $form->dropDownList($model, 'TYPE_ID', HoleTypes::getList(), array('prompt'=>Yii::t('template', 'DEFECTTYPE'))); 
echo $form->dropDownList($model, 'STATE', $model->Allstates, array('prompt'=>Yii::t('template', 'DEFECTSTATE'))); 
echo CHtml::submitButton(Yii::t('template', 'SEARCH')); 
echo '<br/>';

$this->endWidget();

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
</div>

<div class="rCol">
<script>
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

</script>				
   <?php 
   $this->widget('zii.widgets.CListView', array(
   	'id'=>'holes_list',
   	'ajaxUpdate'=>true,
   	'dataProvider'=>$model->userSearch(),
   	'itemView'=>'_view',
   	'itemsTagName'=>'ul',
   	'cssFile'=>Yii::app()->request->baseUrl.'/css/holes_list.css',
   	'itemsCssClass'=>'holes_list',
   	'summaryText'=>false,
   	'viewData'=>Array('showcheckbox'=>true, 'user'=>$user),
   	'afterAjaxUpdate'=> 'function(id){
   		checkInList();
     }',
   )); 
   ?>
</div>
