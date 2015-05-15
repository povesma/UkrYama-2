<?php
    $jsFile = CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'jquery.cookie.js');
    Yii::app()->getClientScript()->registerScriptFile($jsFile);

    $showAboutCookie = Yii::app()->request->cookies['show_about'];
    $showBlock = true;

    if ( $showAboutCookie && $showAboutCookie->value == 'false' ){
        $showBlock = false;
    }
?>

<div class="rCol">
<?
    if (Yii::app()->user->id == 6) {
?>
<div name=warning>  Шановний <h1>openid.yandex.ru/demchmax</h1> Зв'яжіться, будь ласка, з УкрЯмою: 
<a href=mailto:info@ukryama.com>info@ukryama.com</a><br>
<p align=right>Дмитро Повесьма<p></div>
<?      
    }
?>
	<div class="aboutProject-placeholder" <?php echo $showBlock ? 'hidden' : ''?>><a href="#" id="show-about"><?php echo Yii::t('template', 'HOW_WORKS') ?>?</a></div>
	<div class="aboutProject-wrap <?php echo !$showBlock ? 'hidden' : ''?>">
		<h2><?php echo Yii::t('template', 'HOW_WORKS') ?></h2>
		<ul class="aboutProject">
			<li class="about1"><span class="img"></span><br/><?php echo Yii::t('template', 'HOW_WORKS_ABOUT1') ?></li>
			<li class="about2"><span class="img"></span><br/><?php echo Yii::t('template', 'HOW_WORKS_ABOUT2') ?></li>
			<li class="about3"><span class="img"></span><br/><?php echo Yii::t('template', 'HOW_WORKS_ABOUT3') ?></li>
		</ul>
		<a href="#" id="close-about"><?php echo Yii::t('template', 'HIDE') ?></a>
	</div>
</div>
<script>
	$('#close-about').click(function(e){
        $.cookie('show_about', 'false', { expires: 7 });
		$(this).closest('.aboutProject-wrap').slideUp(180, function(){$(this).addClass('hidden')});
		$('.aboutProject-placeholder').slideDown(180);
		e.preventDefault();
	});
	$('#show-about').click(function(e){
        $.cookie('show_about', 'true', { expires: 7 });
		$('.aboutProject-wrap').slideDown(180, function(){$(this).addClass('hidden')});
		$('.aboutProject-placeholder').slideUp(180);
		e.preventDefault();
	});
</script>
