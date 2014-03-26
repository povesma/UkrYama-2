<?php $this->beginContent('//layouts/main'); ?>
<div class="head">
   <div class="container">
      <div class="lCol">
         <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl."/images/logo.png", $this->pageTitle), "/", array('class'=>'logo', 'title'=>Yii::t('template','GOTO_MAIN'))); ?>
      </div>
      <h1><?php echo $this->title; ?></h1>
   </div>
</div>
<a href="http://stfalcon.github.io/euromaidan/" class="em-ribbon" style="position: absolute; left:0; top:0; width: 90px; height: 90px; background: url('http://stfalcon.github.io/euromaidan/img/em-ribbon.png'); z-index: 2013; border: 0;" title="Розмісти стрічку з символікою України і ЄС на своєму сайті!" target="_blank"></a>
<!--<br clear="all" />-->
<div class="mainCols">
	<?php echo $content; ?>	
</div>
<?php $this->endContent(); ?>
