<?php if($email_only): ?>
	<br><?= Yii::t('holes_view', 'EMAIL_ONLY_TEXT') ?> <?= $email_only ?>
<?php endif;?>
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
