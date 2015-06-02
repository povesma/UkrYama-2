<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="ru" />
<meta name="copyright" content="ukryama" />
<meta name="robots" content="index, follow" />
<link rel="icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/template_styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<!--[if lte IE 7]><link rel="stylesheet" href="/css/ie.css" type="text/css" /><![endif]-->


<?php

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl().'/jui/css/base/jquery-ui.css');

?>
</head>
<body>

<script type="text/javascript">
   $(document).ready(function(){
   	if ($('.name a').width() > $('.auth .name').width()){
         $('.grad').show()
  		}
   })

   //$(".change-language").click( function(){
   function changeLanguage($lang){

      //$lang = $(this).attr("lang");
      var theDate = new Date();
      var oneWeekLater = new Date(theDate.getTime() + 1000 * 60 * 60 * 24 * 100);
      var expiryDate = oneWeekLater.toString();

      document.cookie = 'prefLang=' + $lang + '; expires=' + expiryDate + '; path=/;';
      $.ajax({
          type: "POST",
          url: "<?php echo $this->createUrl("site/changelang")?>",
          cache: false,
          data: "lang="+$lang,
          dataType: "html",
          timeout: 5000,
          success: function (data) {
              window.location.reload();
          }
      });
      return false;
  }
</script>
<div class="wrap">
<div class="navigation">
   <div class="container">
		<?php $this->widget('zii.widgets.CMenu',array(
		'items'=>array(
			array('label'=>Yii::t("template", "MENU_TOP_ABOUT"), 'url'=>array('/site/page', 'view'=>'about')),
			array('label'=>Yii::t("template", "MENU_TOP_MAP"), 'url'=>array('/holes/map')),
			array('label'=>Yii::t("template", "MENU_TOP_STANDARDS"), 'url'=>array('/site/page', 'view'=>'regulations')),
			array('label'=>Yii::t("template", "MENU_TOP_STATISTICS"), 'url'=>array('/statics/index')),
			array('label'=>Yii::t("template", "MENU_TOP_FAQ"), 'url'=>array('/site/page', 'view'=>'faq')),
			array('label'=>Yii::t("template", "MENU_TOP_MANUALS"), 'url'=>array('/sprav/index')),
			//array('label'=>'Logout ('.$this->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!$this->user->isGuest)
		),
		'htmlOptions'=>array('class'=>'menu'), 
		'firstItemCssClass'=>'first',
		'activeCssClass'=>'selected',
	)); ?>
   
      <!-- Выбор языка -->
      <div class="change-language">   
         <?php if(Yii::app()->language == "ru"):?>
         <a href="#" onclick="changeLanguage('ua');" class="ukr">Українською</a>
         <?php else: ?>
         <a href="#" onclick="changeLanguage('ru');" class="ru">По-русски</a>
         <?php endif;?>
      </div>
      
      <?php echo CHtml::link(Yii::t('template', 'help_project'), array('/site/page', 'view'=>'donate'), array('class'=>"help-link")) ?> 
            
      <!-- Поиск по адресу -->
		<div class="search">
			<form action="/map">
		      <input type="image" name="s" src="<?php echo Yii::app()->request->baseUrl; ?>/images/search_btn.gif" class="btn" /><input type="text" class="textInput inactive" name="q"  value="" />
		      <span class="placeholder"><?php echo Yii::t("template", "FIND_BY_ADRESS");?></span>
         </form>
		</div>
      
      <!-- Кнопка добавить -->
      <?php if ((Yii::app()->getController()->getAction()->controller->getId() != 'holes') || (Yii::app()->getController()->getAction()->controller->action->id != 'index')): ?>
      <div class="add-yama-container">
         <?php echo CHtml::link(CHtml::tag('span', array(), Yii::t('template', 'ADD_DEFECT')), array('/holes/add')); ?>
      </div>
      <?php endif;?>
		
      <!-- Кнопка Вход/Выход -->
      <div class="auth">
		<?php if(!$this->user->isGuest) : ?>
         <div class="name">
            <p>
               <?php echo CHtml::link($this->user->fullname,Array('/holes/personal')); ?>
               <?php echo CHtml::link('',Array('/site/logout'),Array('title'=>Yii::t("template", "LOGOUT"), 'class' => 'logout')); ?>
            </p>
            <span class="grad"></span>
		    </div>
		<?php else: ?>
         <?php echo CHtml::link(Yii::t("template", "LOGIN"),Array('/holes/personal'),Array('title'=>Yii::t("template", "LOGOUT"), 'class'=>'profileBtn')); ?>
         <div id='loginCode' style="color:black;"></div>
         <script type="text/javascript">
          var checking = false;
          function checkCode(){
            if(!checking){
              checking=true;
              $.get("/userGroups/user/checkcode",function(data){
                if(data["status"]=="new"||data["status"]=="wait"){
                  loginCode.innerText=data["code"];
                }else if(data["status"]=="ok"){
                  location.reload();
                }else if(data["status"]=="new-ok"){
                  document.location="/profile/update/";
                }
                checking=false;
              });
            }
          }
          setInterval('checkCode()',1000);
         </script>
		<?php endif; ?>
      <style type="text/css">
			.auth .name	{width: 150px !important;}						
		</style>
					
		</div>
	</div>
</div>
	
		<?php echo $content; ?>

<div class="bottom-content clearfix">
   <div class="r-col">
      <ul class="socbuttons">
			<li class="rss"><noindex><a href="http://ukryama.info/rss/new/" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl?>/images/social_icons.png" alt="RSS" class="quimby_search_image"></a></noindex></li>
			<li class="twitter"><noindex><a href="http://twitter.com/ukryama" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl?>/images/social_icons.png" alt="Twitter" class="quimby_search_image"></a></noindex></li>
			<li class="vkontakte"><noindex><a href="http://vkontakte.ru/ukryama" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl?>/images/social_icons.png" alt="VKontakte" class="quimby_search_image"></a></noindex></li>
			<li class="facebook"><noindex><a href="http://www.facebook.com/ukryama" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl?>/images/social_icons.png" alt="Facebook" class="quimby_search_image"></a></noindex></li>
		</ul>
   		<?php $this->widget('zii.widgets.CMenu',array(
      		'items'=>array(
      			array('label'=>Yii::t("template", "inform_foot")),
                    
      			array('label'=>Yii::t("template", "help_project"), 'url'=>array('/site/page', 'view'=>'donate')),
                       array('label'=>Yii::t("template", "api"), 'url'=>array('/site/page', 'view'=>'api')),
      			array('label'=>Yii::t("template", "social"), 'url'=>"http://ukryama.info/", 'linkOptions'=>array('target'=>"_blank")),
               array('label'=>Yii::t("template", "partners"), 'url'=>array('/site/page', 'view'=>'partners')),
      			array('label'=>Yii::t("template", "thanks"), 'url'=>array('/site/page', 'view'=>'thanks')),
      			array('label'=>Yii::t("template", "smi"), 'url'=>array('/site/page', 'view'=>'smi')),
                 
      		),
      		'htmlOptions'=>array('class'=>'small-menu'), 
   	  )); ?>
            
		</div>
	
		</div>
	</div>
  
	<div class="footer">
		<div class="container">
			<p class="rosyama"><noindex><a class="rs" target="_blank" href="http://rosyama.ru/" title="РосЯма">РосЯма</a></noindex><br/>Яму мне запили!<br/></p>
			<p class="copy">Идея — <noindex><a href="http://navalny.ru/" rel="nofollow" target="_blank">Алексей Навальный</a></noindex>, 2011<br />
   			Хостинг — «<noindex><a href="http://www.ukraine.com.ua/" target="_blank" rel="nofollow">Украина</a></noindex>»<br />
   			<span class="studio-copyright">Дизайн — веб-студия <a href="http://stfalcon.com" target="_blank"><span class="icon"></span>stfalcon.com</a></span>
   			Разработано в <noindex><a href="http://pixelsmedia.ru" rel="nofollow" target="_blank">Pixelsmedia</a> </noindex>на Yii.<br/>
                           Поддержка сайта <noindex><a href="http://force-it.org" rel="nofollow" target="_blank">force-it.org</a></noindex>.<br/>
   			<a href="http://novus.org.ua/" style="background:none;" class="notus-logo" target="_blank"><img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo-novus.png"></a>
			</p>

			
         <?php 
            if($this->beginCache('countHoles', array('duration'=>3600))) {		
               $this->widget('application.widgets.collection.collectionWidget'); 		
               $this->endCache(); 
            }             
         ?>
         		
			<p class="info"></p>
		</div>
	</div>
	
	<?php if (!$this->user->isGuest && $flash=$this->user->getFlash('user')):?>
   	<div id="addDiv">
   		<div id="fon">
   		</div>
   		<div id="popupdiv">
   		<?php echo ($flash); ?>			
   			 <span class="filterBtn close">
   				<i class="text">Продолжить</i>
   			 </span>
   		</div>
   	</div>
   		
   	<script type="text/javascript">
   		$(document).ready(function(){				
   			$('.close').click(function(){
   				$('#popupdiv').fadeOut(400);
   				$('#fon').fadeOut(600);
   				$('#addDiv').fadeOut(800);
   			})
   		})	
   	</script>
	<?php endif; ?>
   </div>
</body>
</html>
