<? 
$this->pageTitle=Yii::app()->params['langtitle'].$model->name.'Справочник ГАИ ';
$this->title=CHtml::link('Справочник ГАИ', Array('index')).' > '.$model->name;
?>
	<?php
		if(Yii::app()->getLanguage()=="ru"){$lang="ru";}else{$lang="ua";}
		$param="auth_".$lang;
//		$auth=$model->$param->condition("type=:type",array(":type"=>2));
		$auth=Authority::model()->find('region_id=:region and type=2 and lang=:lang',array(':region'=>$model->id,':lang'=>$model->lang));
		if ($auth) : ?>
		<div class="news-detail  sprav-detail">
		<?php $this->renderPartial('_view_gibdd', array('data'=>$auth)); ?>
		</div>
		<br/><br/>
	<?php endif; ?>
