<style>
#map-canvas {
	height: 500px;
	width: 700px;
}
</style>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'holes-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); 
echo $form->errorSummary($model); ?>
	<!-- правая колоночка -->
	<div class="rCol side_section"> 
		<ul class="add_steps clear">
			<li class="step_1 clear">
				<div class="step_number clear">
					<span class="clear">1</span>
				</div>
				<p><?php echo Yii::t('template', 'HOW_ADD_STEP1')?></p>
			</li>
			<li class="step_2 clear">
				<div class="step_number clear">
					<span class="clear">2</span>
				</div>
				<p><?php echo Yii::t('template', 'HOW_ADD_STEP2')?></p>
			</li>
			<li class="step_3 clear">
				<div class="step_number clear">
					<span class="clear">3</span>
				</div>
				<p><?php echo Yii::t('template', 'HOW_ADD_STEP3')?></p>
			</li>
		</ul>
	</div>
	<!-- /правая колоночка -->
	<script type="text/javascript">
		$(document).ready( function(){

			$('.defect_type li input').click(function(){
				$('.defect_type li').removeClass('checked');
				$(this).parent('li').addClass('checked');
			});

		});
	</script>

	<!-- левая колоночка -->
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>-->
<?php if($model->isNewRecord): ?>
<script src="/js/markers.js"></script>
<?php endif; ?>
<script>
function initialize() {
  var markers = [];
  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(<?= $model->LATITUDE ?>,<?= $model->LONGITUDE ?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDoubleClickZoom: true
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Create the search box and link it to the UI element.
  var input = document.getElementById('target');
  var searchBox = new google.maps.places.SearchBox(input);

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };
	if(place.types[1]=="political"){
		map.setZoom(12);
<?php if($model->isNewRecord): ?>
		setMarkers(map);
<?php endif; ?>
	}
	if(place.types=="route"){
		map.setZoom(14);
<?php if($model->isNewRecord): ?>
		setMarkers(map);
<?php endif; ?>
		var marker = new google.maps.Marker({
			map: map,
		        icon: image,
	        	title: place.name,
	        	position: place.geometry.location
		});
	      markers.push(marker);
	}
      bounds.extend(place.geometry.location);
    }
	map.setCenter(bounds.getCenter());
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });

var defectMarker = new google.maps.Marker({
	map: map,
<?php if($model->isNewRecord): ?>
	visible: false,
<?php else: ?>
	position: new google.maps.LatLng(<?= $model->LATITUDE ?>,<?= $model->LONGITUDE ?>),
<?php endif; ?>
	draggable:true,
	icon: "/images/pmvvs.png"
});

  google.maps.event.addListener(map, 'dblclick', function(data) {
	defectMarker.setVisible(true);
	defectMarker.setPosition(data['latLng']);
	updateAddress();
  });
  google.maps.event.addListener(defectMarker, 'dragend', function(data) {
	updateAddress();
  });

<?php if($model->isNewRecord): ?>
  google.maps.event.addListener(map, 'idle',function(){setMarkers(map);});
<?php endif; ?>
  var infowindow = new google.maps.InfoWindow();
	function updateAddress(){
//		geo.geocode({addr ess: "",location:marker.position, region: "uk"},function(callback){
		$.post("/event/GetAddress",{"lat":defectMarker.position['lat'](),"lng":defectMarker.position['lng']()},function(data){
			var resp = JSON.parse(data);

			var cord = new google.maps.LatLng(defectMarker.position['lat']()+0.003/Math.pow(2,(map.zoom-12)), defectMarker.position['lng']());
			var info = resp['results'][0].address_components;
//			var address=info[3]['long_name']+", "+info[2]['long_name']+", "+info[1]['long_name']+", "+info[0]['long_name'];
			var streetNumber, route, locality, sublocality, administrative_area_level_2, administrative_area_level_1;
			for(i=0;i<info.length;i++){
				switch(info[i]['types'][0]){
					case "street_number":
						streetNumber=info[i]['long_name'];
					break;
					case "route":
						route=info[i]['long_name']+", ";
					break;

					case "sublocality":
						sublocality=info[i]['long_name']+", ";
					break;

					case "locality":
						locality=info[i]['long_name']+", ";
					break;

					case "administrative_area_level_2":
						administrative_area_level_2=info[i]['long_name']+", ";
					break;
					case "administrative_area_level_1":
						administrative_area_level_1=info[i]['long_name']+", ";
					break;

				}
			}

			administrative_area_level_1=(administrative_area_level_1=== undefined)?"":administrative_area_level_1;
            
            if(administrative_area_level_1 == 'місто Київ, ') administrative_area_level_1 = ""; // Місто загальноукраїнського значення
            if(administrative_area_level_1 == 'місто Севастополь, ') administrative_area_level_1 = ""; // Місто столичного підпорядкування 
            locality=(locality=== undefined)?"":locality; // Якщо мапа віддалена ГуглМап не парсить назву міста/селища 
            
			sublocality=(sublocality=== undefined)?"":sublocality;
            route=(route=== undefined)?"":route;
			streetNumber=(streetNumber=== undefined)?"":streetNumber;
            
			address=administrative_area_level_1+locality+sublocality+route+streetNumber; // + locality

			Holes_ADDRESS.value=address;
			infowindow.setContent(address);
			infowindow.maxWidth=200;
			infowindow.setPosition(cord);
			infowindow.open(map);

//			var pos = defectMarker.getPosition();
			Holes_LATITUDE.value=defectMarker.position['lat']();
			Holes_LONGITUDE.value=defectMarker.position['lng']();
            
    
		});
	}
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
	<div class="lCol main_section">
<?php if(!(Yii::app()->user->getId())){ ?>
<table>
<tr>
    <td><?= $form->labelEx($model,'EMAIL') ?></td><td><?= $form->textField($model,'EMAIL', array( "style"=>"width:250px")) ?></td>
    <?= $form->error($model,'EMAIL') ?>
</tr>
<tr>
    <td><?= $form->labelEx($model,'FIRST_NAME') ?></td><td><?= $form->textField($model,'FIRST_NAME',array( "style"=>"width:250px")) ?></td>
    <?= $form->error($model,'FIRST_NAME') ?>

    <td><?= $form->labelEx($model,'LAST_NAME') ?></td><td><?= $form->textField($model,'LAST_NAME',array( "style"=>"width:200px")) ?></td>
    <?= $form->error($model,'LAST_NAME') ?>
</tr>
</table>
<?php }else{ ?>
<?= $form->hiddenField($model,'EMAIL', array("value"=>"1")) ?>
<?= $form->error($model,'EMAIL') ?>

<?= $form->hiddenField($model,'FIRST_NAME',array("value"=>"1")) ?>
<?= $form->error($model,'FIRST_NAME') ?>

<?= $form->hiddenField($model,'LAST_NAME',array("value"=>"1")) ?>
<?= $form->error($model,'LAST_NAME') ?>
<?php } ?>
		<div class="form_top_bg clear">
			<div class="google-search-form" style="padding-bottom: 0px;">
				<table>
				      <input id="target" type="text" placeholder="Поиск">
				</td></tr>
				</table>
			</div>	
			<div id="map-canvas"></div>
			<!-- адрес -->
			<div class="f">
				<?php echo $form->labelEx($model,'ADDRESS'); ?>
				<?php echo $form->textField($model,'ADDRESS',array('class'=>'textInput')); ?>
				<?php echo $form->error($model,'ADDRESS'); ?>	
				<p class="tip">
               <?php echo Yii::t('template', 'ENTER_POINT_TO_MAP_DOBLECLICK')?>					
				</p>
			</div>
		</div>
			
		<!-- тип дефекта -->
		<div class="f clearfix">
			<?php echo $form->labelEx($model,'TYPE_ID'); ?>

			<ul class="defect_type clearfix"> 
         <?php 
				$data = CHtml::listData(HoleTypes::getTypes(), 'id','alias');
				foreach($data as $id => $alias){
				   $name = Yii::t('holes','HOLES_TYPE_'.strtoupper($alias));

               echo CHtml::tag('li', array('style'=>'float:none'), 
                  CHtml::radioButton(
                     'Holes[TYPE_ID]', 
                     $model->TYPE_ID == $id, 
                     array('value'=>$id, 'id'=>'type_'.$alias)
                  ).
                  CHtml::label($name, 'type_'.$alias)                  
               );
				}
			?> 
		         </ul>
			<?php echo $form->error($model,'TYPE_ID'); ?>
		</div>
	
		
		<!-- Дата обнаружения -->
		<div class="f clearfix">

        
        <?php echo $form->labelEx($model,'DATE_CREATED'); ?>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'DATE_CREATED',
    'htmlOptions' => array(
        'size' => '10',         // textField size
        'maxlength' => '10',
        'value' => date("d.m.Y",$model->DATE_CREATED),    // textField maxlength
    ),
));
?>
<?php echo $form->error($model,'DATE_CREATED'); ?>
        
		</div>


         	
		<!-- фотки -->
		<div class="f clearfix">
			<?php echo $form->labelEx($model,'upploadedPictures'); ?>
			<?php $this->widget('CMultiFileUpload', array('accept'=>'gif|jpg|png|jpeg', 'model'=>$model, 'attribute'=>'upploadedPictures', 'htmlOptions'=>array('class'=>'mf'), 'denied'=>Yii::t('mf','Невозможно загрузить этот файл'),'duplicate'=>Yii::t('mf','Файл уже существует'),'remove'=>Yii::t('mf','удалить'),'selected'=>Yii::t('mf','Файлы: $file'),)); ?>			
			<p class="tip">
            <?php echo Yii::t('template', 'ENTER_PHOTO_REMARK')?>	         
         </p>			
		</div>
						<?php
				if(!$model->isNewRecord && $model->pictures_fresh && $model->STATE!=Holes::STATE_FIXED)
				{
					?>
					<div id="overshadow"><span class="command" onclick="document.getElementById('picts').style.display=document.getElementById('picts').style.display=='block'?'none':'block';"><?php echo Yii::t('template', 'INFO_CANDELETEPHOTO')?></span><div class="picts" id="picts">
					<?php
					foreach($model->pictures_fresh as $i=>$picture){				
						echo '<br>'.$form->checkBox($model,"deletepict[$i]", array('class'=>'filter_checkbox','value'=>$picture->id)).' ';
						echo $form->labelEx($model,"deletepict[$i]", array('label'=>Yii::t('template', 'DELETEPICT'))).'<br><img src="'.$picture->medium.'"><br><br>';
					}
					echo '</div></div>';
				} ?>

		<!-- камент -->
		<div class="f">
			<?php echo $form->labelEx($model,'COMMENT1'); ?>
			<?php echo $form->textArea($model,'COMMENT1',array('height'=>"150px")); ?>
			<?php echo $form->error($model,'COMMENT1'); ?>
		</div>
		<?php echo $form->hiddenField($model,'LATITUDE'); ?>
		<?php echo $form->hiddenField($model,'LONGITUDE'); ?>
		<?php echo $form->hiddenField($model,'ADR_CITY'); ?>

		<div class="addSubmit">
			<div onclick="$(this).parents('form').submit();">
				<a class="addFact"><i class="text"><?php echo Yii::t('template', 'SEND')?></i><i class="arrow"></i></a>
			</div>
			<p><?php echo Yii::t('template', 'INFO_AFTERSEND')?></p>
		</div>
	</div>
	<!-- /левая колоночка -->
<?php $this->endWidget(); ?>
