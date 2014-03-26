<style>
.btn-addhole {cursor:pointer;}
.btn-map {cursor:pointer;}
.btn-defect {cursor:pointer;}
#addhole .center{text-align:center;}
#type_lbl {height:20px;}
#map-canvas {height:90%;width:100%;}
#big_map {display:none;}
#mini_map {display:none;}
#minimap-canvas {width:300px;height:290px;}
#haddress {width:160px;}
.btn-map {cursor:pointer; text-decoration:underline;}
.ok-btn {float:right}
</style>
<div id="addhole" style="">
<div id="big_map" style="background-color:#ccc">
	<div class="google-search-form" style="padding-bottom: 0px;">
		<input width="700px" id="target" type="text" placeholder="Пошук">
		<input type="button" class="ok-btn" onClick="big_map.style['display']='none'" value="OK">
	</div>
	<div id="map-canvas"></div>
	<input type="button" class="ok-btn" onClick="big_map.style['display']='none'" value="OK">
</div>
<div id="mini_map">
	<table>
	<tr><td style="background-color:#ccc;"><div style="float:right;cursor:pointer;" onClick="mini_map.style['display']='none'"><u>X</u></div></td></tr>
	<tr><td><div id="minimap-canvas"></div></td></tr>
	</table>
</div>
<form enctype="multipart/form-data" method="POST" target="postYama" name="yamaForm" id="yamaForm" action="http://ukryama.com/holes/smallhole" onSubmit="validate(this);return false;">
<!-- Персональные данные -->
<table id="addyama">
<tr><td colspan=4>Email: <input name="umail" id="umail"> Им'я: <input name="uname" id="uname"></td></tr>
<!-- Карта/адрес -->
<tr><td colspan=4><span class="btn-map" onClick="big_map.style['display']='inline';initialize(new google.maps.LatLng(<?=$model->LONGITUDE ?>,<?=$model->LATITUDE ?>))">Адреса:</span> <span id="addbox" name="addbox"><input style="width:345px" id="haddress" name="haddress" onClick="miniInit(this)"></span>
<input type="hidden" name="poslat" id="poslat"><input type="hidden" name="poslon" id="poslon">
</tr>
<!-- Фотографи -->
<tr><td valign="top" id="filez" name="filez">Фото дефекту:</td>
<td>
<?php $this->widget('CMultiFileUpload', array('accept'=>'gif|jpg|png|jpeg', 'model'=>$model, 'attribute'=>'upploadedPictures', 'htmlOptions'=>array('class'=>'mf multi'), 'denied'=>Yii::t('mf','Неможливо завантажити цей файл'),'duplicate'=>Yii::t('mf','Файл вже iснує'),'remove'=>Yii::t('mf','видалити'),'selected'=>Yii::t('mf','Файли: $file'),)); ?>
</td>
<td rowspan=2><a href="http://ukryama.com/"><img width="70px" src="http://ukryama.com/images/logo.png"></a></td></tr>
<tr><td colspan=2>
<!-- Тип дефекта -->
<select style="width:165px" name="deftype" id="deftype" onChange="if(this[0].value=='0')this.remove(0);">
<option value="0">-==Тип дефекту==-
<?php
$defects = HoleTypes::model()->findAll('published=:stat and lang=:lang',array(':stat'=>1,':lang'=>"ua"));
foreach($defects as $defect):
?>
<option value="<?= $defect->id ?>"><?= $defect->name ?>
<?php endforeach;?>
</select>
<input type="submit" value="Надiслати"></td></tr>
</table>
</form>
<table id="finalPage" style="display:none">
<tr><td><div id="message"></div></td></tr>
</table>
<iframe id="postYama" name="postYama" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
</div>
