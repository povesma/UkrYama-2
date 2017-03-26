<html>
<head>
<title></title>
</head>
<body>
<table>
<tr>
	<td></td>
	<td class="head" colspan=2><p>Кому: <?= $to_name ?><br>Куди: <?= $to_address ?><br> Від: <?= $from_name ?><br>Адреса: <?= $from_address ?></p></td>
</tr>
<tr>
<td class="ref"><div class="ref">Вих. №<?= $ref ?>-1 від: <?= $date ?> р.</div></td><td>&nbsp;</td>
</tr>
<tr><td colspan=2 class="v-spacer"></td></tr>
<tr><td colspan=2 class="title">
<div>Скарга</div>
</td></tr>
<tr><td colspan=2 class="smv-spacer"></td></tr>
<tr><td colspan=2 class="a-body">
<div> QQQQQ
<b><?= $when ?> р.</b> 
мною на території дороги за адресою: <b><?= $where ?></b>  були виявлені недоліки дороги, 
розміри яких не відповідають вимогам Державного стандарту України ДСТУ 3587-97 <br>
<?= $sent_date?> мною було направлено скаргу з цього приводу у <?= $first_auth?>, яка була доставлена <?=$delivery_date?>. Станом на 
сьогодні мною не отримано жодної відповіді або повідомлення про продовження розгляду, відтак посадові особи, відповідальні за розгляд звернень,
порушують вимоги ст. 7 Закону "Про звернення громадян" та, відповідно, моє право на звернення.
<br><br>
Окрім того, моя скарга є повідомленням про адміністративне правопорушення. 
Відповідно до п. 3 ч. 1 ст. 10 Закону «Про міліцію», міліція зобов'язана приймати та реєструвати заяви та повідомлення про 
адміністративні правопорушення та вчасно  приймати рішення за ними. Цього зроблено не було.<br><br>
В зв'язку з викладеним, керуючись ст. 40 Конституції України, <b>прошу:</b><br>
<ol>
<li>Прийняти та зареєструвати цю скаргу, негайно організувати перевірку вказаних фактів.</li>
<li>Вжити дій для поновлення мого права на звернення та негайного надання відповіді на моє звернення.</li>
<li>Притягнути до відповідальності осіб, винних у порушенні мого права на звернення.</li>
<li>Про результати розгляду цієї заяви та про вжиті заходи прошу повідомити мені письмово.</li>
</ol>
</div>
</td></tr>
<tr><td colspan=2 class="smv-spacer"></td></tr>
<tr><td colspan=2 >
  <table><tr valign=center>
	<td valign=center class="date"><?= $date ?>&nbsp;р.</td>
<?php if($signature): ?>
	<td valign=center><img src="<?= $signature ?>"></td>
<?php endif;?>
	<td valign=center class="init"><?= $init ?></td>
  </tr></table>
</td>
</tr>
<tr><td colspan=2 class="v-spacer"></td></tr>
<?php if($c_photos): ?>
<tr><td class="attach">Додаю: <?= $c_photos ?> фото.</td></tr>
<?php endif;?>
</table>
<?php if($c_photos): ?>
<pagebreak />
<table>
<?= $files ?>
</table>
<?php endif;?>
</body>
</html>
