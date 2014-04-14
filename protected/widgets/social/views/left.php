<!-- <div id="competition">
<h2>Внимание! Конкурс.</h2>
<noindex><a href="http://www.ahelp.ua/competition-rde2012.html" target="_blank" title="Конкурс УкрЯма" alt="Конкурс УкрЯма" /><img src="<?php echo Yii::app()->request->baseUrl?>/images/newroad.jpg" width="195"></a></noindex>
</div><br /> -->



<div id="from_blog">
	<script src="http://www.google.com/jsapi?key=internal-sample" type="text/javascript"></script>
	<script language="Javascript" type="text/javascript">//<![CDATA[
		google.load("feeds", "1");
		function OnLoad() {
		var feedControl = new google.feeds.FeedControl();
		feedControl.addFeed("http://ukryama.info/rss/", "<h2>Сообщество УкрЯмы</h2>Новости:");
		feedControl.setNumEntries(4)
		feedControl.setLinkTarget(google.feeds.LINK_TARGET_BLANK );
		feedControl.draw(document.getElementById("feedControl"));
		}
		google.setOnLoadCallback(OnLoad);
	//]]>
	</script> 
	<div id="feedControl">Загрузка постов…</div>
</div>

<?php
    // last comments
    $this->widget("comments.widgets.ECommentsLastListWidget", array(
                "showCountRecords"=>10,
                "textLength"=>100
            ));
?>

<!-- 
<div class="yaDirect">
        <script type="text/javascript">
        //<![CDATA[
        yandex_partner_id = 78872;
        yandex_site_bg_color = 'FFFFFF';
        yandex_site_charset = 'utf-8';
        yandex_ad_format = 'direct';
        yandex_font_size = 1;
        yandex_direct_type = 'vertical';
        yandex_direct_limit = 4;
        yandex_direct_title_font_size = 2;
        yandex_direct_title_color = '046AB2';
        yandex_direct_url_color = '637280';
        yandex_direct_text_color = '000000';
        yandex_direct_hover_color = '66B2FF';
        yandex_direct_favicon = false;
        document.write('<sc'+'ript type="text/javascript" src="http://an.yandex.ru/system/context.js"></sc'+'ript>');
        //]]>
        </script>
</div> 
-->

<div id="banner_ap">
	<span>Партнеры:</span>
	<div class="banner_yama">
	<br />
		<noindex>
		<div id="rontar_adplace_1159"></div>
		<script type="text/javascript"><!--
		 
			(function (w, d, n) {
				var ri = { rontar_site_id: 956, rontar_adplace_id: 1159, rontar_place_id: 'rontar_adplace_1159', adCode_rootUrl: 'http://adcode.rontar.com/' };
				w[n] = w[n] || [];
				w[n].push(
					ri
				);
				var a = document.createElement('script');
				a.type = 'text/javascript';
				a.async = true;
				a.src = 'http://adcode.rontar.com/rontar2_async.js?rnd=' + Math.round(Math.random() * 100000);
				var b = document.getElementById('rontar_adplace_' + ri.rontar_adplace_id);
				b.parentNode.insertBefore(a, b);
			})(window, document, 'rontar_ads');
		//--></script>
		</noindex>
	</div>
	<br />
	<div id="partners">
		SSL сертификаты и <a href="http://www.isplicense.ru/" target="_blank">лицензии ПО</a>
	</div> 
</div>
	
	<!--
	
	
	<div class="like">
		<!-- Facebook like -->
	<!--	<div id="fb_like">
			<iframe src="http://www.facebook.com/plugins/like.php?href=http://<?php echo $_SERVER['SERVER_NAME'] ?>/&amp;layout=button_count&amp;show_faces=false&amp;width=180&amp;action=recommend&amp;font&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:180px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- Vkontakte like -->
	<!--	<div id="vk_like"></div>
		<script type="text/javascript">VK.Widgets.Like("vk_like", {type: "button", verb: 1});</script>
	</div>-->
