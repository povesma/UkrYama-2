<div id="holesent" name="holesent" style="display:none">
<?php
	error_log("Auth selection Logging here\n", 3, "php-log.log");

	$mytype=$hole->type->findByPk(array("id"=>$hole->TYPE_ID,"lang"=>"ua"));
	try {
		error_log("Auth selection for the primary claim: RegionID: ".strval($hole->region()->name).", mytype: ".strval($mytype->name)."\n", 3, "php-log.log");
	} catch (Exception $e) {
		$e = "some error ".$e->getMessage();
		error_log("Auth selection err: ".$err."\n", 3, "php-log.log");
	} 

	$choices=$hole->getAllAuth($hole->region(),$mytype,"ua");
	$ref=0;

 	$superiors = array();

	if($req){ // first request (claim) has already been sent. Look for parents
		error_log("Auth selection req exists ".strval($req->auth_ua->id)."\n", 3, "php-log.log");
		$superiors=$req->auth_ua->parents("ua");
		$ref=$req->id;
	}
	
	$choices = array_merge($choices, $superiors);
?>
<table>
	<form name="simple" action="/holes/sent/<?=$hole->ID?>/" method="POST" onSubmit="if(when.value.length<8){ $('#when').effect('highlight', {}, 3000); when.focus(); return false;}">
	<tr><td>Куди була направлена скарга?</td><td></tr>
	<tr><td>
		<select name="auth" id="auth">
			<option value="0">. . .
			<?php foreach($choices as $choice) {?>
				<option value="<?= $choice->id?>"><?=$choice->name?>
			<?php } ?>
		</select>
	</td></tr>
	<tr><td>Яким чином доставлена скарга?</td><td></tr>
<tr><td>
	<?= CHtml::link('Заніс особисто', "javascript:void(0)",array('class'=>"declarationBtn",'onClick'=>'btnz = $(".declarationBtn"); for(i=0;i<btnz.length;i++){ btnz[i].style["font-weight"]="";};this.style["font-weight"]="bold";mailtype.value="1";subwd.style["display"]="inline";wd.style["display"]="inline";rcptform.style["display"]="none"')) ?><br>
	<?= CHtml::link('Простим листом', "javascript:void(0)",array('class'=>"declarationBtn",'onClick'=>'btnz = $(".declarationBtn"); for(i=0;i<btnz.length;i++){ btnz[i].style["font-weight"]="";};this.style["font-weight"]="bold";mailtype.value="2";subwd.style["display"]="inline";wd.style["display"]="inline";rcptform.style["display"]="none"')) ?><br>
	<?= CHtml::link('Рекомендованим листом', "javascript:void(0)",array('class'=>"declarationBtn",'onClick'=>'btnz = $(".declarationBtn"); for(i=0;i<btnz.length;i++){ btnz[i].style["font-weight"]="";};this.style["font-weight"]="bold";subwd.style["display"]="none";wd.style["display"]="inline";rcptform.style["display"]="inline";')) ?>
</td>
	<input type="hidden" name="mailtype" id="mailtype">
	<input name="ref" type="hidden" value="<?= $ref ?>">
	<tr><td><div style="display:none" id="wd" name="wd">Коли:<br>
                    <input type="text"  placeholder="напр. 2015-11-25" onfocus="this.placeholder = ''" onblur="this.placeholder = 'напр. 2015-11-25' />
                    <input type="date" max="<?= date('Y-m-d',time())?>"  name="when" id="when"><br><input id="subwd" name="subwd" type="submit" value="OК"></div></td></tr>
	</form>
</tr>
	<tr>
<td><div style="display:none" name="rcptform" id="rcptform">
	<form method="POST" action="/holes/sent/<?=$hole->ID?>" onSubmit="if(rcpt.value.length<13){ $('#rcpt').effect('highlight', {}, 3000); rcpt.focus(); return false;}else if(when.value.length<8){ $('#when').effect('highlight', {}, 3000); when.focus(); return false;}else{when2.value=when.value;auth2.value=auth.value}">
	Уведiть штрих-кодовий iдентифiкатор(ШКI):<input type="text" onkeyup="this.value=this.value.replace(/[^\d]/,'')" name="holesent[rcpt]" id="rcpt"><br>
	Приклад штрих-кодового iдентифiкатору<br><a target="_blank" href="/images/rcpt.jpg" ><img width=150px src="/images/rcpt.jpg"></a><br>
	<input name="when2" id="when2" type="hidden"><br/>
	<input name="ref" type="hidden" value="<?= $ref ?>">
	<input name="auth2" id="auth2" type="hidden" value="<?= $ref ?>">
	<input type="checkbox" checked onChange="if(this.checked){nomail.style['display']='inline'}else{nomail.style['display']='none'}" name="holesent[mailme]" id="mailme"> повiдомити про доставку по ел. почтi.<br>
	<div id="nomail">
<?php
	if(!strlen(Yii::app()->user->email)){
		echo "Уведiть ваш email <input name='nomail'>";
	}
?>
	</div>
	<input type="submit" value="ОК"></div>
	</form>
</td></tr>

</table>
</div>
