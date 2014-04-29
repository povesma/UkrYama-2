<?
$this->title = Yii::t("template", "MANUALS_GIBDD");
$this->pageTitle = Yii::app()->params['langtitle'].$this->title;
$this->layout='//layouts/header_blank';
?>

<div class="news-list sprav-list">
<?php foreach ($model as $subj) : ?>
	<p class="news-item">
		<?php echo CHtml::link('('.($subj->id < 10 ? '0'.$subj->id : $subj->id).') '.CHtml::encode($subj->name),Array('view','id'=>$subj->id)); ?>
	</p>
<?php endforeach; ?>				
</div>
