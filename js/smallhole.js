function initialize(location) {
  var markers = [];
  var mapOptions = {
    zoom: 14,
    center: location,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    disableDoubleClickZoom: true
  };

  var marker = new google.maps.Marker({
      position: location,
      map: map,
      title: 'Вулиця'
  });
  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  var input = document.getElementById('target');
  var searchBox = new google.maps.places.SearchBox(input);
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }
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
	}
	if(place.types=="route"){
		map.setZoom(14);
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
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });

var defectMarker = new google.maps.Marker({
	map: map,
	visible: false,
	draggable:true,
	icon: "http://newtest.ukryama.com/images/pmvvs.png"
});

  google.maps.event.addListener(map, 'dblclick', function(data) {
	defectMarker.setVisible(true);
	defectMarker.setPosition(data['latLng']);
	updateAddress();
  });
  var infowindow = new google.maps.InfoWindow();
	function updateAddress(){
		$.post("http://newtest.ukryama.com/event/GetAddress",{"lat":defectMarker.position['lat'](),"lng":defectMarker.position['lng']()},function(data){
			var resp = JSON.parse(data);

			var cord = new google.maps.LatLng(defectMarker.position['lat']()+0.003/Math.pow(2,(map.zoom-12)), defectMarker.position['lng']());
			var info = resp['results'][0].address_components;
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
			administrative_area_level_1=(administrative_area_level_1=== undefined)?"1":administrative_area_level_1;
			sublocality=(sublocality=== undefined)?"":sublocality;
			route=(route=== undefined)?"":route;
			streetNumber=(streetNumber=== undefined)?"":streetNumber;
			address=administrative_area_level_1+sublocality+route+streetNumber;

			mini_map.style['display']='none';
			ha = $("#haddress");
			ha.remove();
			addbox.innerHTML='<input style="width:345px" id="baddress" name="haddress">';
			baddress.value=address;
			infowindow.setContent(address);
			infowindow.maxWidth=200;
			infowindow.setPosition(cord);
			infowindow.open(map);
			poslat.value=defectMarker.position['lat']();
			poslon.value=defectMarker.position['lng']();
		});
	}
}
$(window).keydown(function(e){
	if (e.keyCode==27){
		var c=document.getElementById('big_map');
		if(c){
			c.style.display='none';
			e.preventDefault();
		}
	}


});

function listener(event){
//  if ( event.origin !== "http://javascript.info" )
//    return
	window.parent.finalPage.style['display']='inline';
	window.parent.addyama.style['display']='none';
	document.getElementById("message").innerHTML = event.data
}
if (window.addEventListener){
  addEventListener("message", listener, false)
} else {
  attachEvent("onmessage", listener);
}

function validate(form){
		x = form.umail;
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

		x = form.uname;
		if (x.value==null || x.value=="")
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
		x = form.haddress;
		if (x.value==null || x.value=="")
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
		x = form.deftype;
		if (x.value=="0")
		{
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
		x = filez;
		if($(form).find("input:file").length<2){
			$(x).effect("highlight", {}, 3000);
			x.focus();
			return false;
		}
		form.submit();
}

//big_map.style['display']='inline';initialize('<?= $model->LONGITUDE ?>', '<?= $model->LATITUDE ?>')
function miniInit(box){
	var searchBox = new google.maps.places.SearchBox(box);
	google.maps.event.addListener(searchBox, 'places_changed', function() {
		var places = searchBox.getPlaces();
		var bounds = new google.maps.LatLngBounds();
		for (var i = 0, place; place = places[i]; i++) {
//			if(place.types=="route"){
				$("#mini_map").css('display','inline');
				var mapOptions = {
					zoom: 14,
					center: place.geometry.location,
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDoubleClickZoom: true
				};
				var map = new google.maps.Map(document.getElementById('minimap-canvas'),mapOptions);

				var marker = new google.maps.Marker({
					map: map,
					title: place.name,
					position: place.geometry.location
				});

				poslat.value=marker.position['lat']();
				poslon.value=marker.position['lng']();

				google.maps.event.addListener(map, 'mouseover', function(data) {
					big_map.style['display']='inline';
					initialize(place.geometry.location);
				});
				return true;
//			}
		}
	});
}
