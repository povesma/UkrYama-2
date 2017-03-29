<html>
<head>
<title></title>
</head>
<body>
<table>
<tr>
	<td></td>
	<td class="head" colspan=2><p>Кому: <?= $to_name ?><br>Куди: <?= $to_address ?><br>Від: <?= $from_name ?><br>Адреса: <?= $from_address ?>
<?php if($email_only): ?>
	<br><?= Yii::t('holes_view', 'EMAIL_ONLY_TEXT') ?> <?= $email_only ?>
<?php endif;?>

</p></td>
</tr>
<tr>
<td class="ref"><div class="ref">Вих. №<?= $ref ?> від: <?= $date ?> р.</div></td><td>&nbsp;</td>
</tr>
<tr><td colspan=2 class="v-spacer"></td></tr>
<tr><td colspan=2 class="title">
<div>Заява</div>
</td></tr>
<tr><td colspan=2 class="smv-spacer"></td></tr>
<tr><td colspan=2 class="a-body">
