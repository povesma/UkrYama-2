<style>
#tpoll01{
	width:800px;
	padding-bottom:20px;
}
#poll01{
	/*color:#090080;*/
	font-size:12pt;
}
#poll01 thead{
	margin-bottom:20px;
}
#poll01 td{
	padding-top: 5px;
	padding-left:20px;
	padding-bottom:5px;
}
#poll01 tbody{
/*	background-color:#f0f0f0; */
}
#poll01 li span{
	cursor:pointer;
}
#poll01 input[type=checkbox]{
	cursor:pointer;
}
#poll01 input[type=radio]{
	cursor:pointer;
}
.point{
	cursor:pointer;
}
#poll01 .required{
	position:relative;
	top:-10px;
	color:red;
}
#poll01 .sub{
	font-size:10pt;
}
#poll01 input[type=text]{
	width:140px;
}
</style>
<script>
function validator(form){
<?php if(!(Yii::app()->user->getId())){ ?>	
		x = form.email;
		if (x.value==null || x.value=="")
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
		var atpos=x.value.indexOf("@");
		var dotpos=x.value.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		x = form.first_name;
		if (x.value==null || x.value=="")
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

<?php } ?>
	form.submit();
}
</script>
<div id="tpoll01">
<table id="poll01">
<thead><tr><td>
<div><p>К сожалению, нет эффективных электронных способов отправки официальных жалоб на состояние дорог.
Единственный действенный способ - гарантированная доставка бумажного документа лично или почтой.</p>
<p>Многие пользователи сайта не отправляют бумажные заявления в ГАИ по разным причинам. 
Мы планируем это делать по поручению таких пользователей за плату. Мы рассчитываем, что в этом случае будет больше отправленных жалоб, 
соответственно больше исправленных ям.</p>
<p>Просим ответить на несколько вопросов, чтобы понять, как нам лучше всего это сделать. 
Ваше мнение очень важно для нас.</p></div>
</td></tr></thead>

<tbody>
<form method="POST" onSubmit="validator(this);return false;">
<?php if(!(Yii::app()->user->getId())){ ?>
	<tr><td>Ваш e-mail<span class="required">*</span> <input type=text name="email"> Ваше имя<span class="required">*</span> <input type=text name="first_name"></td></tr>
	<tr><td></td></tr>
<?php } ?>
	<tr><td><b>Готовы ли вы распечатать заявление от своего имени и отправить его в ГАИ заказным письмом?</b></td><tr>
	<tr><td style="padding-left:60px;">
		<input type=radio name=group1 id="group1_yes" value="yes" onChange="if(this.checked){fcount.style['display']='inline';ifcount.style['display']='inline';}"><span class="point" onClick="group1_yes.checked=true;fcount.style['display']='inline';ifcount.style['display']='inline';"> &nbsp;Да &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<input type=radio name=group1 value="no" id="group1_no" onChange="if(this.checked){fcount.style['display']='none';ifcount.style['display']='none';}"><span class="point" onClick="group1_no.checked=true;fcount.style['display']='none';ifcount.style['display']='none';"> &nbsp;Нет</span></td></tr>
	<tr><td style="display:none;" id="fcount" name="fcount"><b>Сколько раз вы уже отправляли заявления в ГАИ?</b></td></tr>
	<tr><td style="display:none;padding-left:60px;" id="ifcount" name="ifcount"><input name="tcount" type=number value=0 min=0> <input type=checkbox name="toomuch" onChange="if(this.checked){tcount.disabled=true}else{tcount.disabled=false;}">не помню, много!</td></tr>
	<tr><td><b>Что мешает вам или другим пользователям отправлять заявления по почте от своего имени?</b></td></tr>
	<tr><td>
		<ul>
			<li><input name="ch[8]" id="ch_8" type=checkbox><span onClick="if(ch_8.checked){ch_8.checked=false}else{ch_8.checked=true}"> &nbsp;а что, нужно отправлять?</span></li>
			<li><input name="ch[0]" id="ch_0" type=checkbox><span onClick="if(ch_0.checked){ch_0.checked=false}else{ch_0.checked=true}"> &nbsp;не хочу указывать свое имя или адрес</span></li>
			<li><input name="ch[1]" id="ch_1" type=checkbox><span onClick="if(ch_1.checked){ch_1.checked=false}else{ch_1.checked=true}"> &nbsp;у меня нет принтера</span></li>
			<li><input name="ch[2]" id="ch_2" type=checkbox><span onClick="if(ch_2.checked){ch_2.checked=false}else{ch_2.checked=true}"> &nbsp;нет времени ходить на почту</span></li>
			<li><input name="ch[3]" id="ch_3" type=checkbox><span onClick="if(ch_3.checked){ch_3.checked=false}else{ch_3.checked=true}"> &nbsp;не знаю, как подписывать конверт</span></li>
			<li><input name="ch[4]" id="ch_4" type=checkbox><span onClick="if(ch_4.checked){ch_4.checked=false}else{ch_4.checked=true}"> &nbsp;не знаю, как оформлять отправку заказным письмом</span></li>
			<li><input name="ch[5]" id="ch_5" type=checkbox><span onClick="if(ch_5.checked){ch_5.checked=false}else{ch_5.checked=true}"> &nbsp;это, наверное, дорого</span></li>
			<li><input name="ch[6]" id="ch_6" type=checkbox><span onClick="if(ch_6.checked){ch_6.checked=false}else{ch_6.checked=true}"> &nbsp;это все слишком сложно</span></li>
			<li><input name="ch[7]" id="ch_7" type=checkbox onChange="if(this.checked) {ownr02.style['display']='inline'}else{ownr02.style['display']='none'}"><span onClick="if(ch_7.checked){ch_7.checked=false;ownr02.style['display']='none'}else{ch_7.checked=true;ownr02.style['display']='inline'}"> &nbsp;своя причина</span> <input name="ownr02" id="ownr02" style="display:none"></li>
		</ul>
		</td></tr>
	<tr><td><b>Если бы сайт предлагал отправку жалобы на состояние дороги от имени УкрЯмы, с дальнейшим сканированием ответа и отправкой вам, сколько бы вы готовы были за это заплатить?</b></td></tr>
	<tr><td><span class="sub">min</span> <input name="money" type=range min=1 max=75 value=15 onChange="range.innerText=this.value"> <span class="sub">max</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b name=range id=range>15</b> грн. (<i><a href="javascript:void(0);" onClick="if(ownr03.style['display']=='none') {ownr03.style['display']='inline'}else{ownr03.style['display']='none'}"> свой вариант</a></i> <input name="ownr03" id="ownr03" style="display:none">)</td></tr>
	<tr><td style="padding-right:60px; float:right;"><input type="submit" value="Отправить"></td></tr>
</form>
</tbody>
</table>
</div>
