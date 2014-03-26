<?php
/**
 * available variables inside the $data array:
 * '{email}'=> user email address,
 * '{username}'=> username,
 * '{activation_code}'=> activation code if available,
 * '{link}'=> short link without get parameters,
 * '{full_link}'=> full link with get parameters,
 * '{website}'=> value of the appName parameter inside your configuration file
 * '{temporary_username}' => boolean: true if the username is temporary and can be changed
 *
 * usage example:
 * $data['{link}']
 */
?>
<p>Запрошуємо вас приєднатися до проекту <?= $data['{website}'] ?>.<br/>
Для активації акаунту та встановлення нового паролю натисніть посилання:<br/>
<?php echo $data['{full_link}']; ?>&UserGroupsUser[active]=1<br/>
або перейдіть за адресою:<br/>
<?php echo $data['{link}']; ?><br/>
та вставте в форму настурні дані:<br/>
ім'я користувача: <b><?php echo $data['{username}']; ?></b><br/>
код активації: <b><?php echo $data['{activation_code}']; ?></b></p>

<?php if ($data['{temporary_username}']) { ?>
<p>У вас буде змога змінити ім'я користувача після активації акаунту.</p>
<p></p>
<p>Бажаємо вам вдалого дня!</p>
<p></p>
<p>З повагою, команда проекту УкрЯма</p>

<?php } ?>
