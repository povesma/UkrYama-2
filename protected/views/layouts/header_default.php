<?php $this->beginContent('//layouts/main'); ?>
<div class="head">
   <div class="container">
      <div class="lCol">
         <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/logo.png", $this->pageTitle), "/", array('class'=>'logo', 'title'=>Yii::t('template','GOTO_MAIN'))); ?>
			<div class="btn">
			   <?php echo CHtml::link('<i class="text">'. Yii::t('holes', 'addholes') .'</i><i class="arrow"></i>',array('/holes/add'),array('class'=>'addFact')); ?>
         </div>
      </div>
      <?php $this->renderPartial('//layouts/_howworks');?>
   </div>
</div>
<a href="http://stfalcon.github.io/euromaidan/" class="em-ribbon" style="position: absolute; left:0; top:0; width: 90px; height: 90px; background: url('http://stfalcon.github.io/euromaidan/img/em-ribbon.png'); z-index: 2013; border: 0;" title="Розмісти стрічку з символікою України і ЄС на своєму сайті!" target="_blank"></a>
<div class="mainCols">
	<?php echo $content; ?>
</div>			
<?php $this->endContent(); ?>

