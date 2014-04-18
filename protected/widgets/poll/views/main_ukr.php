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
<div><p>Нажаль, нема ефективних електроннів засобів доставки офіційних скарг та заяв на стан доріг.
Єдиний дієвий спосіб - гарантован доставка паперового документу особисто або поштою.</p>
<p>Багато користувачів сайту завантажують недоліки на сат, проте не відправляють листа в ДАІ з різних причин. 
Ми плануємо робити це за дорученням користувачів за плату. Розраховуємо, що в такому випадку буде більше відправлених скарг, відтак
відтак більше виправлених недоліків доріг.</p>
<p>Просимо відповісти на кілька питань, щоб зрозуміти, як нам це найкраще зробити. 
Ваша думка важлива для нас.</p></div>
</td></tr></thead>

<tbody>
<form method="POST" onSubmit="validator(this);return false;">
<?php if(!(Yii::app()->user->getId())){ ?>
	<tr><td>Ваш e-mail<span class="required">*</span> <input type=text name="email"> Ваше им'я<span class="required">*</span> <input type=text name="first_name"></td></tr>
	<tr><td></td></tr>
<?php } ?>
	<tr><td><b>Чи готові ви роздрукувати заяву та відправити її в ДАІ рекомендованим листом звичайною поштою?</b></td><tr>
	<tr><td style="padding-left:60px;">
		<input type=radio name=group1 id="group1_yes" value="yes" onChange="if(this.checked){fcount.style['display']='inline';ifcount.style['display']='inline';}"><span class="point" onClick="group1_yes.checked=true;fcount.style['display']='inline';ifcount.style['display']='inline';"> &nbsp;Так &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
		<input type=radio name=group1 value="no" id="group1_no" onChange="if(this.checked){fcount.style['display']='none';ifcount.style['display']='none';}"><span class="point" onClick="group1_no.checked=true;fcount.style['display']='none';ifcount.style['display']='none';"> &nbsp;Ні</span></td></tr>
	<tr><td style="display:none;" id="fcount" name="fcount"><b>Скільки разів ви вже відправляли скарги поштою?</b></td></tr>
	<tr><td style="display:none;padding-left:60px;" id="ifcount" name="ifcount"><input name="tcount" type=number value=0 min=0> <input type=checkbox name="toomuch" onChange="if(this.checked){tcount.disabled=true}else{tcount.disabled=false;}">не пам'ятаю, багато!</td></tr>
	<tr><td><b>Що заважає вам чи іншим користувачам (на вашу думку) відправляти заяви поштою від свого імені?</b></td></tr>
	<tr><td>
		<ul>
			<li><input name="ch[8]" id=ch_8 type=checkbox><span onClick="if(ch_8.checked){ch_8.checked=false}else{ch_8.checked=true}"> &nbsp;а що, треба відправляти?!</span></li>
			<li><input name="ch[0]" id="ch_0" type=checkbox><span onClick="if(ch_0.checked){ch_0.checked=false}else{ch_0.checked=true}"> &nbsp;не хочу вказувати свое ім'я та адресу</span></li>
			<li><input name="ch[1]" id="ch_1" type=checkbox><span onClick="if(ch_1.checked){ch_1.checked=false}else{ch_1.checked=true}"> &nbsp;у меня немає принтера</span></li>
			<li><input name="ch[2]" id="ch_2" type=checkbox><span onClick="if(ch_2.checked){ch_2.checked=false}else{ch_2.checked=true}"> &nbsp;немає часу ходити на пошту</span></li>
			<li><input name="ch[3]" id="ch_3" type=checkbox><span onClick="if(ch_3.checked){ch_3.checked=false}else{ch_3.checked=true}"> &nbsp;не знаю, як підписати конверт</span></li>
			<li><input name="ch[4]" id="ch_4" type=checkbox><span onClick="if(ch_4.checked){ch_4.checked=false}else{ch_4.checked=true}"> &nbsp;не знаю, як оформити відправку заказним листом</span></li>
			<li><input name="ch[5]" id="ch_5" type=checkbox><span onClick="if(ch_5.checked){ch_5.checked=false}else{ch_5.checked=true}"> &nbsp;це, напевне, дорого</span></li>
			<li><input name="ch[6]" id="ch_6" type=checkbox><span onClick="if(ch_6.checked){ch_6.checked=false}else{ch_6.checked=true}"> &nbsp;це все занадто складно для мене</span></li>
			<li><input name="ch[7]" id="ch_7" type=checkbox onChange="if(this.checked) {ownr02.style['display']='inline'}else{ownr02.style['display']='none'}"><span onClick="if(ch_7.checked){ch_7.checked=false;ownr02.style['display']='none'}else{ch_7.checked=true;ownr02.style['display']='inline'}"> &nbsp;своя причина</span> <input name="ownr02" id="ownr02" style="display:none"></li>
		</ul>
		</td></tr>
	<tr><td><b>Якщо б сайт пропонував відправки скарги чи заяви на стан дороги ві імені УкрЯми, з подальшим скануванням відповіді,
та відправкою вам, скільки б ви були готові заплатити за це?</b></td></tr>
	<tr><td><span class="sub">min</span> 
    

    
    <input id="money" name="money" type=range min=1 max=75 value=15 > 
    <span class="sub">max</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b name=range id=range>15</b> грн. 
        <script type="text/javascript">
    var p = document.getElementById("money"),
        res = document.getElementById("range");
        
        p.addEventListener("input", function() {
            res.innerHTML = p.value;
        }, false);
    </script>
    (<i><a href="javascript:void(0);" onClick="if(ownr03.style['display']=='none') {ownr03.style['display']='inline'}else{ownr03.style['display']='none'}"> свій варіант</a></i> <input name="ownr03" id="ownr03" style="display:none">)</td></tr>
	<tr><td style="padding-right:60px; float:right;"><input type="submit" value="Я так думаю"></td></tr>
</form>
</tbody>
</table>
</div>
