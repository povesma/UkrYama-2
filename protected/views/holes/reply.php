<?php
$requests=$hole->requests_user;
if(count($requests)>0){
	$req=$requests[count($requests)-1];
}
$param="auth_ua"; // тут треба правильно визначити мову, поки - чарівна та солов'їна. Yii::app()->user->getLanguage();
//$this->title = Yii::t('holes_view', 'HOLE_REPLY').$req->$param->name;
//$this->pageTitle=Yii::app()->name . ' :: '.$this->title;


$answer = new HoleAnswers;
?>
<script src="http://ukryama.com/js/highlight.js"></script>
<script>
function validate(form){
		x = filez;
		if($(form).find("input:file").length<2){
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
form.submit();
}
</script>
<!--<h1><?php echo $this->title; ?></h1>-->
<form method="POST" enctype="multipart/form-data" onSubmit="validate(this);return false" id="ansform" name="ansform">
<table>
<tr><td></td><td></td></tr>
<tr><td><?=Yii::t('template', 'REPLYING_TO_RESPONSE_FROM')?>:</td><td>
<?php
	foreach($requests as $request){
		echo "<span onClick='req_".$request->id.".checked=true'><input type='radio' name='req_id' id='req_".$request->id."' value='".$request->id."'>".$request->$param->name."</span><br>";
	}
?>
</td></tr>
<tr><td><?=Yii::t('template', 'RESPONSEDATE')?></td><td><input type="date" id="answerdate" name="answerdate" max="<?= date('Y-m-d',time()) ?>" value="<?= date('Y-m-d',time()) ?>"></td></tr>
<tr><td id="filez"><?= Yii::t('template', 'INFO_NEED_ADD_SCAN_RESPONSE') ?></td><td><?php $this->widget('CMultiFileUpload',array('accept'=>'gif|jpg|png|pdf|txt', 'model'=>$answer, 'attribute'=>'uppload_files', 'htmlOptions'=>array('class'=>'mf'), 'denied'=>Yii::t('mf','Невозможно загрузить этот файл'),'duplicate'=>Yii::t('mf','Файл уже существует'),'remove'=>Yii::t('mf','удалить'),'selected'=>Yii::t('mf','Файлы: $file'),)); ?></td></tr>
<tr><td><?=Yii::t('template', 'COMMENTS_IF_NEED')?></td><td><textarea id="comment" name="comment"></textarea></td></tr>
<tr><td></td><td>&nbsp;</td></tr>
<tr><td colspan=2 style="text-align:center"><a class="addFact" onClick="ansform.onsubmit();"><i class="text"><?php echo Yii::t('template', 'SEND')?></i><i class="arrow"></i></a></td></tr>

</table>
</form>
