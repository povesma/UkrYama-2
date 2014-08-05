<?php $this->beginContent('//layouts/main'); ?>
<div class="head">
		<div class="container">
			<div class="lCol">
					<a href="/" class="logo" title="На главную"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png"  alt="УкрЯма" /></a>
			</div>

			<?php $this->renderPartial('//layouts/_text');?>
		</div>
	</div>
	<!-- BUG: Повернути взад 
<a href="http://stfalcon.github.io/euromaidan/" class="em-ribbon" style="position: absolute; left:0; top:0; width: 90px; height: 90px; background: url('http://stfalcon.github.io/euromaidan/img/em-ribbon.png'); z-index: 2013; border: 0;" title="Розмісти стрічку з символікою України і ЄС на своєму сайті!" target="_blank"></a>-->
	<div class="mainCols">
	<?php echo $content; ?>
	</div>		
	
<?php $this->endContent(); ?>
