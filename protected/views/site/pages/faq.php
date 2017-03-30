<?
$this->pageTitle=Yii::app()->params['langtitle'].'FAQ';
$this->layout='//layouts/header_blank';
?>
<div class="lCol">
<?php $this->widget('application.widgets.news.newsWidget'); ?>
<?php $this->widget('application.widgets.social.socialWidget'); ?>
</div>
<div class="rCol">
<h1>Вопросы и ответы</h1>
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">Где можно получить больше информации, пообщаться с единомышленниками, и т. д?Есть ли требования к оформлению жалобы?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>
			<p>То, как будет написана жалоба (размер шрифта и всё остальное) — не имеет значения. Главное, чтобы присутствовали ваши имя с фамилией, почтовый адрес (чтобы вы могли получить письменный ответ). Жалоба, которую генерирует УкрЯма — полностью готова к отправке (только не забудьте, пожалуйста, вписать свои данные).</p>
                        </td>
		</tr>		
	</table>	

<!--	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">Где я могу скачать мобильные приложения для УкрЯмы под IPhone или Android?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td><p>Приложение для IPhone: <a href="http://itunes.apple.com/ru/app/id456229487?mt=8">http://itunes.apple.com/ru/app/id456229487?mt=8</a></p>
			    <p>Приложение для Android от UnrealMojo: <a href="https://market.android.com/details?id=ru.rosyama.android">https://market.android.com/details?id=ru.rosyama.android</a></p>
			    <p>Приложение для Android от RedSolution: <a href="https://market.android.com/details?id=ru.redsolution.rosyama">https://market.android.com/details?id=ru.redsolution.rosyama</a></p>
			    <p>Приложение для Samsung Bada: <a href="http://www.samsungapps.com/topApps/topAppsDetail.as?productId=G00004062550">http://www.samsungapps.com/topApps/topAppsDetail.as?productId=G00004062550</a></p>
			    <p>Приложение для Windows Phone: <a href="http://www.windowsphone.com/ru-RU/apps/783e000f-c9ac-4c11-af17-f5e465cd881b">http://www.windowsphone.com/ru-RU/apps/783e000f-c9ac-4c11-af17-f5e465cd881b</a></p>
			</td>

		</tr>		
	</table>	
-->
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">УкрЯма есть в соц. сетях?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>
			<p>Наши официальные группы: <a href="http://vk.com/ukryama" title="УкрЯма ВКонтакте" target="_blank" >ВКонтакте</a>, <a href="https://www.facebook.com/ukryama" title="Фейсбук УкрЯмы" target="_blank" >Facebook</a>, <a href="https://twitter.com/#!/ukryama" title="Твиттер УкрЯмы" target="_blank" >Twitter</a>. Пока всё.</p>
			</td>

		</tr>		
	</table>	

	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">Для чего нужен сайт?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>УкрЯма — сайт, который помогает гражданам Украины бороться с проблемами дорожного покрытия в нашей стране (ямами, выбоинами и прочим) и бездействием различных служб в их устранении.</td>
		</tr>		
	</table>	
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">Как это работает?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>Вы фотографируете яму на дороге (или другой дефект), 
		<a href="http://ukryama.com/personal/add.php" title="Добавить яму или другой дефект дорожного полотна" >
		добавляете</a> снимок на сайт с указанием адреса (на карте). 
                Распечатываете жалобу в полицию, кладете в конверт и отправляете заказным письмом. 
		Более подробно изложено в разделе &laquo;<a href="/page/about/#pr" title="О проекте «УкрЯма&raquo;, порядок работы" >Порядок работы</a>».</td>
		</tr>		
	</table>	
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">А если яма во дворе?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>ДСТУ 3587-97 распространяется на все дороги, 
		<a href="http://ukryama.com/personal/add.php" title="Добавить яму или другой дефект дорожного полотна" >
		добавляете</a> снимок на сайт с указанием адреса (на карте). 
                Распечатываете жалобу в полицию, кладете в конверт и отправляете заказным письмом. 
		Более подробно изложено в разделе &laquo;<a href="/page/about/#pr" title="О проекте «УкрЯма&raquo;, порядок работы" >Порядок работы</a>».</td>
		</tr>		
	</table>	
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">А вы имеете отношение к РосЯме?</td>
		</tr>		

		<tr>
			<th>A:</th>                                    	
			<td>РосЯма помогла нам идеей изначальным программным кодом сервиса. 
Идеологически, мы похожи на, но с учетом украинского законодательства. 
На Украине поддержкой и развитием проекта занимается команда добровольцев: Дмитрий Повесьма, Дмитрий Шевцов, 
Григорий Кравцов и другие.
</td>
		</tr>		
	</table>	
	<table class="faq-item">
		<tr>
			<th>Q:</th>
			<td class="question">У вас на сайте есть яма, которую уже заделали. Автор ямы, похоже, забыл про неё. Как можно пометить яму, как исправленную, если не я её создал?</td>
		</tr>		
		<tr>
			<th>A:</th>
			<td>Пришлите на <a class="txttohtmllink" href="mailto:info@ukryama.com" title="Написать письмо">info@ukryama.com</a> фотографию исправленного участка, желательно с того же ракурса, что и раньше. Укажите номер дефекта на сайте. Мы отметим факт исправления дефекта вручную.</td>
		</tr>		
	</table>	
</div>