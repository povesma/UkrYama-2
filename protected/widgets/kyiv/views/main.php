<style>
#map-canvas {
	height: 500px;
	width: 750px;
}
#comform form{
	width:100%;
}
#comform input{
	width:100%;
}

#comform textarea{
	width:100%;
}

#comform {
	margin-top:50px;
}
.btn{
	display:inline;
}
.btn-primary{
	background-color:white;
	color:black;
}
.btn-primary.disabled,
.btn-primary[disabled],
fieldset[disabled] .btn-primary,
.btn-primary.disabled:hover,
.btn-primary[disabled]:hover,
fieldset[disabled] .btn-primary:hover,
.btn-primary.disabled:focus,
.btn-primary[disabled]:focus,
fieldset[disabled] .btn-primary:focus,
.btn-primary.disabled:active,
.btn-primary[disabled]:active,
fieldset[disabled] .btn-primary:active,
.btn-primary.disabled.active,
.btn-primary[disabled].active,
fieldset[disabled] .btn-primary.active {
	background-color:white;
	color:black;
}

</style>

<script>
	function autoreg(){
<?php if(!(Yii::app()->user->getId())){ ?>
		$.post("/userGroups/user/autoregister",{
		'CommunityForm[firstName]':community.CommunityForm_firstName.value,
		'CommunityForm[lastName]':community.CommunityForm_lastName.value,
		'CommunityForm[email]':community.CommunityForm_email.value,
		},function(data){
				postEvent(data);
			});
<?php }else{ ?>
		postEvent(<?= Yii::app()->user->getId() ?>);
<?php } ?>
	}
	function postEvent(uid){
		message = community.CommunityForm_message.value;
		address = community.address.value;
		lat = community.lat.value;
		lng = community.lng.value;
		files=community.files.value;
		b = $("input:checkbox:checked");
		var c = new Array();
		for(var a=0;a<b.length;a++){
			c[a]=b[a].value;
		}
		c=c.join(",");
		$.post("/event/AddEvent",{"uid":uid,"message":message,"lat":lat,"lng":lng,"address":address,"tid":c, "files":files}, function(data){if(data==1){$("#comform").html("<h2>Щиро дякуемо за участь! Зробимо наше мiсто краще разом!</h2>")}});
	}
	function pform(){
		if(validateForm()){
			autoreg();
		}
	}
	function validateForm()
	{
<?php if(!(Yii::app()->user->getId())){ ?>
		x = community.CommunityForm_firstName;
		if (x.value==null || x.value=="")
		{
		//	$("#"+x.id).append("<b style='color:red'>Це поле мусить бути заповненно</b>");
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		x = community.CommunityForm_lastName;
		if (x.value==null || x.value=="")
		{
//			$("#"+x.id).append("<b style='color:red'>Це поле мусить бути заповненно</b>");
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		x = community.CommunityForm_email;
		if (x.value==null || x.value=="")
		{
//			$("#"+x.id).append("<b style='color:red'>Це поле мусить бути заповненно</b>");
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
<?php } ?>
		x = community.CommunityForm_message;
		if (x.value==null || x.value=="")
		{
//			$("#"+x.id).append("<b style='color:red'>Це поле мусить бути заповненно</b>");
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		x = community.address;
		if (x.value==null || x.value=="")
		{
//			$("#"+x.id).append("<b style='color:red'>Це поле мусить бути заповненно</b>");
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		b = $("input:checkbox:checked");
		x = defects;
		if(! b.length){
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}

		return true;
	}
	function deleteFile(id){
		$.post("/video/deleteFile",{"id":id},function(){
			$('#file_'+id).remove();
		});
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
var map;
function initialize() {
  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(50.4501, 30.523400000000038),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var infowindow = new google.maps.InfoWindow();

  marker = new google.maps.Marker({
    map:map,
    draggable:true,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(50.4501, 30.523400000000038),
    icon: "/images/cur.png"
  });

  event = new Array();
<?php
	$i=0;
	foreach($events as $event){
		echo "event[$i] = new google.maps.Marker({map:map,draggable:false, position: new google.maps.LatLng(".$event['lat'].",".$event['lng']."),animation: google.maps.Animation.DROP});\n";
		echo "google.maps.event.addListener(event[$i], 'click', function(){showEvent(".$event['id'].")});";
		$i++;
	}
?>


//  geo = new google.maps.Geocoder();

  google.maps.event.addListener(marker, "drag", function(){
	infowindow.close();
  });

  google.maps.event.addListener(map, "drag", function(){
	infowindow.close();
	marker.setPosition(map.getCenter());
  });
  google.maps.event.addListener(map, "dragend", function(){
	marker.setPosition(map.getCenter());
	updateAddress();
  });
  google.maps.event.addListener(map, "zoom_changed", function(){
	marker.setPosition(map.getCenter());
	updateAddress();
  });
  google.maps.event.addListener(marker, "dragend", function(){
	updateAddress();
  });

	function updateAddress(){
//		geo.geocode({address: "",location:marker.position, region: "uk"},function(callback){
		$.post("/event/GetAddress",{"lat":marker.position['lat'](),"lng":marker.position['lng']()},function(data){
			var resp = JSON.parse(data);

			var cord = new google.maps.LatLng(marker.position['lat']()+0.003/Math.pow(2,(map.zoom-12)), marker.position['lng']());
			var info = resp['results'][0].address_components;
			var address=info[3]['long_name']+", "+info[2]['long_name']+", "+info[1]['long_name']+", "+info[0]['long_name'];
			community.paddress.value=address;
			infowindow.setContent(address);
			infowindow.maxWidth=200;
			infowindow.setPosition(cord);
			infowindow.open(map);

			var pos = marker.getPosition();
			community.lat.value=marker.position['lat']();
			community.lng.value=marker.position['lng']();
		});
	}
}

google.maps.event.addDomListener(window, 'load', initialize);

function showEvent(id){
	var params = "menubar=no,location=no,resizable=yes,scrollbars=yes,status=yes"
	window.open("/event/ViewEvent/"+id, "Недолiк", params)
}

function addAddress(){
	community.address.value=community.paddress.value;
}
</script>
<h3><a href="/event/ListEvents/">Список усiх недолiкiв</a></h3>
<?php 
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'community',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
    'action'=>'javascript:void(0);',
    'htmlOptions'=>array('name'=>'community','onSubmit'=>'pform(); return false;'),
)); 

$model=new CommunityForm;

?>
<?php echo $form->errorSummary($model); ?>
<table id=comform class="table table-bordered">
<?php if(!(Yii::app()->user->getId())){ ?>
<tr>
    <td><?php echo $form->labelEx($model,'firstName'); ?></td>
    <td><?php echo $form->textField($model,'firstName'); ?></td>
    <?php echo $form->error($model,'firstName'); ?>
    <td></td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'lastName'); ?></td>
    <td><?php echo $form->textField($model,'lastName'); ?></td>
    <?php echo $form->error($model,'lastName'); ?>
    <td></td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'email'); ?></td>
    <td><?php echo $form->textField($model,'email'); ?></td>
    <?php echo $form->error($model,'email'); ?>
    <td></td>
</tr>
<?php } ?>
<tr>
    <td><?php echo $form->labelEx($model,'message'); ?></td>
    <td><?php echo $form->textArea($model,'message'); ?></td>
    <?php echo $form->error($model,'message'); ?>
    <td></td>
</tr>
<input type=hidden name=files id=files>
<tr><td colspan=2><?$this->widget('ext.EFineUploader.EFineUploader',
 array(
       'id'=>'FineUploader',
       'config'=>array(
                       'autoUpload'=>true,
                       'request'=>array(
                          'endpoint'=>"/video/upload",
                          'params'=>array('YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken),
                                       ),
                       'retry'=>array('enableAuto'=>true,'preventRetryResponseProperty'=>true),
                       'chunking'=>array('enable'=>true,'partSize'=>100),//bytes
                       'callbacks'=>array(
                                        'onComplete'=>"js:function(id, name, response){ 
						community.files.value=community.files.value+response.id+\",\"; 
						$('.uploaded-files').append('<li class=\'nfile\' id=file_'+response.id+'>'+response.filename+' <u><a href=javascript:void(0) onClick=deleteFile('+response.id+')>Видалити файл</a></u></li>');
					 }",
                                        'onError'=>"js:function(id, name, errorReason){ }",
                                         ),
                       'validation'=>array(
                                 'allowedExtensions'=>Yii::app()->params['upload_ext'],
                                 'sizeLimit'=>157286400,//maximum file size in bytes
                                 'minSizeLimit'=>1024,// minimum file size in bytes
                                          ),
                      )
      ));
 
?><br><ul class="uploaded-files"></ul></td>
    <td></td>
</tr>
<tr>
    <td><?php echo $form->labelEx($model,'address'); ?><br><input name=address id=address><input name=paddress type=hidden id=paddress><br><input type=button 
 value="^ ^ ^" onClick="addAddress()"></td><td></td><td><label>Категорiя недолiку</label></td>
    <?php echo $form->error($model,'address'); ?>
</tr>
<tr id=mapz><td colspan=2><div id="map-canvas"></div></td>
	<td style="overflow:auto;"><div class="btn-group" id="defects" data-toggle="buttons">
<?php
	function get_children($tree, $ref){
		$children = array();
		foreach($tree as $node){
			if($node['refer']==$ref){
				array_push($children,$node);
			}
		}
		return $children;
	}

	function display_nodes($tree, $nodes){
		foreach($nodes as $node){
			$children = get_children($tree, $node['id']);
			if(count($children)>0){
				echo "<li><div class=\"btn2 btn-primary\" disabled>".$node['name']." - ".$node['description']."</div></li>\n";
					echo "<ul>\n";
					display_nodes($tree,$children);
					echo "</ul>\n";
			}else{
				echo "<li style=\"display:auto;width:100%;white-space:normal;\"><div class=\"btn2 btn-primary\" style=\"white-space:normal;display:auto;\"><input style=\"display:none\" type=\"checkbox\" name=\"options[]\" id=\"option_".$node['id']."\" value=".$node['id'].">".$node['name']." - ".$node['description']."</div></li>\n";
			}
		}
	}
	$nodes = get_children($tree,0);
	if(count($nodes)>0){
		echo "<ul class=\"node_0\" id=\"node_0\">\n";
		display_nodes($tree, $nodes);
		echo "</ul>\n";
	}
?>
	</div></td>
</tr>

<input type=hidden name=lat id=lat><input type=hidden name=lng id=lng>
<tr>
	<td colspan=3><?php echo CHtml::submitButton("Вiдправити", Array('class'=>'submit', 'name'=>'community')); ?><!-- Button trigger modal -->
</td>
</tr>

</table>
<?php $this->endWidget(); ?>
