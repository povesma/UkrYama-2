<div class="like">
		<noindex><script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
<div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="button" data-yashareQuickServices="vkontakte,facebook,twitter,lj"></div></noindex><br />
	
</div>
<!-- NEWS -->
<div class="news-list-mainpage">
<?php foreach ($model as $news) : ?>	
	<div class="news-item">		
					<p  class="date"><?php echo Y::dateFromTime($news->date); ?></p>
					<p><?php echo $news->introtext; ?>&nbsp;<?php echo CHtml::link('&rarr;', array('news/view', 'id'=>$news->id), array('class'=>"show")); ?></p>
	</div>
<?php endforeach; ?>
<?php echo CHtml::link(Yii::t('holes','all_news'), array('news/index'), array('class'=>'news-all')); ?>
<div style="clear:both"></div>
</div>
<!-- /NEWS -->
