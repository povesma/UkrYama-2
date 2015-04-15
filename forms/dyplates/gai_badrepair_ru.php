<html>
<head>
<title></title>
</head>
<body>
<table>
<tr>
	<td></td>
	<td class="head" colspan=2><p>Кому: <?= $to_name ?><br>Куди: <?= $to_address ?><br>От: <?= $from_name ?><br>Адрес: <?= $from_address ?></p></td>
</tr>
<tr>
<td class="ref"><div class="ref">Вих. №<?= $ref ?> от: <?= $date ?> г.</div></td><td>&nbsp;</td>
</tr>
<tr><td colspan=2 class="v-spacer"></td></tr>
<tr><td colspan=2 class="title">
<div>Заявление</div>
</td></tr>
<tr><td colspan=2 class="smv-spacer"></td></tr>
<tr><td colspan=2 class="a-body">
<div>
<b><?= $when ?> г.</b> 
мной на территории дороги по адресу: <b><?= $where ?></b> был обнаружен факт ремонта дороги, которым дорожная пыталась устранить недостатки дороги. После проведения ремонта дорога все равно не соответствует требованиям Государственного стандарта Украины ДСТУ 3587-97 — «Автомобильные дороги, улицы и железнодорожные переезды. Требования к эксплуатационному состоянию», отсюда, <b>ремонт произведен с нарушением действующих правил и норм</b>. Максимальний сток, предусмотренный ДСТУ 3587-97 для исправления недостатков дороги составляет 10 суток. Эти недостатки являются опасными для жизни и здоровья участников дорожного движения.<br><br>
Существование указанных недостатков и некачественный ремонт нарушают мое право на безопасные условия дорожного движения, гарантированное статьей 14 Закона Украины «О дорожном движении» и имеют признаки административного нарушения, определенного частью 1 статьи 140 КУоАП.<br>
Возможно, исполнение упомянутого ремонта связано с ранее доданными жалобами на состояние этого участки дороги. Нарушение правил ремонта и содержания дорог является административным правонарушениемпо части 1 статьи 140 КУоАП Украины.<br><br>
В соответствии с частью 10 статьи 52-1 Закона Украины «О дорожном движении» и частью 12 статьи 10 Закона «О милиции», на ГАИ возложена обязанность обеспечения безопасности дорожного движения, государственный контроль, в том числе путем проведения проверок по соблюдению законов, правил и нормативов в сфере дорожного движения. В соответствии с частью 1 статьи 6 КУоАП, органы исполнительной власти и органы местного самоуправления разрабатывают и осуществляют мероприятия, направленные на предотвращение административных правонарушений, выявление и устранение причин и условий, которые к ним приводят.<br> Проведение некачественного ремонта может свидетельствовать о нецелевом использовании бюджетных средств, которые являются признаком криминального правонарушения по статье 210 или статье 367 Уголовного кодекса Украины.<br><br>
В соответствии с пунктом 3 части 1 статьи 10 Закона Украины «О милиции», милиция обязана принимать и регистрировать заявления и сообщения об административных правонарушениях и вовремя принимать решения по ним.<br><br>
В связи с вышеизложенным, пользуясь статьей 40 Конституции Украины, <b>прошу:</b><br>
<ol>
<li>Принять и зарегестрировать это заявление как сообщение об административном правонарушении по статье 140 КУоАП, немедленно организовать проверку указаных фактов.</li>
<li>Принять меры по обеспечению безопасного эксплуатационного состояния указанной дороги и продолжать принимать их до устранения недостатков в соответствии с п.п. 8.3.10.9 - 8.3.10.11 Методических рекомендаций, утвержденных распоряжением МВД Украины №638 от 09.06.2009.</li>
<li>Направить мне копии актов обследования, протоколов, постановлений, требований, предписаний и иных документов, подготовленных в результате проверки и производства в деле по указанным в заявлении фактам (в порядке законодательства о доступе к публичной информации).</li>
<li>Провести проверку законности использования бюджетных средств во время ремонта или направить это сообщение для проведения такой проверки по назначению.</li>
<li>О результатах рассмотрения этого заявления и о принятых мерах прошу сообщить мне письменно.</li>
</ol>

</div>
</td></tr>
<tr><td colspan=2 class="smv-spacer"></td></tr>
<tr>
	<td class="date"><?= $date ?> г.</td>
	<td class="init"><?= $init ?></td>
</tr>
<tr><td colspan=2 class="v-spacer"></td></tr>
<?php if(count($files)): ?>
<tr><td class="attach">Приложение: <?= $c_photos ?> фото</td></tr>
<?php endif;?>
</table>
<?php if(count($files)): ?>
<pagebreak />
<table>
<?= $files ?>
</table>
<?php endif;?>
</body>
</html>
