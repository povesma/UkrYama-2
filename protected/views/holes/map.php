<?php 
$this->pageTitle=Yii::app()->name.' :: '.Yii::t('template', 'MAP_DEFECT');
$this->title = Yii::t('template', 'MAP_DEFECT');
//echo CHtml::tag('h1', array(), Yii::t('template', 'MAP_DEFECT'));
$form=$this->beginWidget('CActiveForm',Array(
	'id'=>'map-form',
	'enableAjaxValidation'=>false,
)); 
?>
<style>
#map-canvas {
	height: 745px;
	width: 1000px;
}
</style>
<div class="filterCol filterStatus">
   <p class="title"><?= Yii::t('template', 'SHOW_DEFECTS_STATE')?></p>
   <?php foreach ($model->allstatesMany as $alias=>$name) : ?>
      <label>
         <span class="<?= $alias; ?>">
            <input class="chn0" name="Holes[STATE][]" type="checkbox"  value="<?= $alias; ?>" />
         </span>
         <ins><?= $name; ?></ins>
      </label>
   <?php endforeach; ?>	
</div>
<div class="filterCol filterType">
   <p class="title"><?= Yii::t('template', 'SHOW_DEFECTS_TYPE')?></p>
   <?php foreach ($types as $i=>$type) : ?>
      <label class="col2">
         <input class="ch0" name="Holes[type][]" type="checkbox" value="<?= $type->id; ?>"/>
         <ins class="<?= $type->alias; ?>">
            <?= $type->getName(); ?>
         </ins>
      </label>
   <?php endforeach; ?>
   <input id="MAPLAT" name="MAPLAT" type="hidden" value="" />
   <input id="MAPZOOM" name="MAPZOOM" type="hidden" value="" />
</div>
<?php $this->endWidget(); ?>

<div class="mainCols">
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script src="/js/markers.js"></script>
<script>
function initialize() {
  var markers = [];
  var mapOptions = {
    zoom: 12,
    center: new google.maps.LatLng(<?= $hole->LONGITUDE ?>, <?= $hole->LATITUDE ?>),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDoubleClickZoom: true
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

	boxes = $(".ch0")
	for(i=0;i<boxes.length;i++){
		boxes[i].addEventListener("click",function(){
			updateMarkers();
		});
	}
	boxes = $(".chn0")
	for(i=0;i<boxes.length;i++){
		boxes[i].addEventListener("click",function(){
			updateMarkers();
		});
	}
	function updateMarkers(){
		var req = "";
		var data = $(".ch0")
		for(i=0;i<data.length;i++){
			if(data[i].checked){req=req+"&Holes[type][]="+data[i].value;}
		}
		data = $(".chn0")
		for(i=0;i<data.length;i++){
			if(data[i].checked){req=req+"&Holes[STATE][]="+data[i].value;}
		}
		setMarkers(map,req);
	}
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
		updateMarkers();
	}
	if(place.types=="route"){
		map.setZoom(14);
		updateMarkers();
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

  google.maps.event.addListener(map, 'idle',function(){updateMarkers();});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
<p>
	<div class="google-search-form" style="padding: 10px;">
		      <input id="target" type="text" placeholder="Поиск" style="width:300px">
	</div>
</p>
	<div id="map-canvas"></div>
</div>
