<?
    $jsFile = CHtml::asset($this->viewPath.DIRECTORY_SEPARATOR.'js'.DIRECTORY_SEPARATOR.'jquery.cookie.js');
    Yii::app()->getClientScript()->registerScriptFile($jsFile);

    $showAboutCookie = Yii::app()->request->cookies['show_about'];
    $showBlock = true;

    if ( $showAboutCookie && $showAboutCookie->value == 'false' ){
        $showBlock = false;
    }
?>

<div class="rCol">
	<div class="aboutProject-placeholder" <?php echo $showBlock ? 'hidden' : ''?>><a href="#" id="show-about">Як працює УкрЯма?</a></div>
	<div class="aboutProject-wrap <?php echo !$showBlock ? 'hidden' : ''?>">
		<h2>Як працює УкрЯма</h2>
		<ul class="aboutProject">
			<li class="about1"><span class="img"></span><br>Добавить факт и&nbsp;отправить заявление в&nbsp;местное ГАИ </li>
			<li class="about2"><span class="img"></span><br>Ждать 31&nbsp;календарный день с&nbsp;момента регистрации вашего заявления</li>
			<li class="about3"><span class="img"></span><br>Если дефект не&nbsp;исправили, отправлять жалобу в&nbsp;прокуратуру</li>
		</ul>
		<a href="#" id="close-about">Приховати</a>
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