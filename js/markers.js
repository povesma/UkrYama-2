var markers2 = [];

Cluster.prototype = new google.maps.OverlayView();

function showDefect(id){
	var params = "menubar=no,location=no,resizable=yes,scrollbars=yes,status=yes"
	window.open("/"+id+"/", "Дефект", params)
}

function SetMarker(map,id,type,lat,lng,state){
		var image={
			url : "/images/st1234/"+type+"_"+state+".png",
			size : new google.maps.Size(54, 61),
			scaledSize : new google.maps.Size(30, 40)
		}
		var marker = new google.maps.Marker({
			map: map,
	        	title: type,
			icon: image,
	        	position: new google.maps.LatLng(lng,lat)
		});
  google.maps.event.addListener(marker, 'click', function() {
	showDefect(id);
  });
markers2.push(marker);
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setAllMap(null);
}
// Shows any markers currently in the array.
function showMarkers(map) {
  setAllMap(map);
}

function setAllMap(map) {
  for (var i = 0; i < markers2.length; i++) {
    markers2[i].setMap(map);
  }
}

function SetCluster(map,count,lat,lng,i){
//	sym = { fillColor: "#ff0000", strokeColor: "#00ff00", path: "M 0 0 L 0 50 L 50 0 z", fillOpacity: 1};
	srcImage="/images/m1.png";
	var overlay = new Cluster(new google.maps.LatLng(lng,lat), srcImage, map,count);
/*
var marker = new google.maps.Marker({
          position: new google.maps.LatLng(lng,lat),
          icon: sym,
          map: map
      });
*/
markers2.push(overlay);
}

function setMarkers(map,req){
	var mtop=map.getBounds().getNorthEast()['lat']();
	var mright=map.getBounds().getNorthEast()['lng']();
	var mbottom=map.getBounds().getSouthWest()['lat']();
	var mleft=map.getBounds().getSouthWest()['lng']();
	var mzoom=map.getZoom();
	var addr='/holes/ajaxMap/?top='+mtop+'&right='+mright+'&bottom='+mbottom+'&left='+mleft+'&zoom='+mzoom+req;
	$.get(addr,function(data){
		data=JSON.parse(data);
		PlaceMarks=new Array;
		clearMarkers();
		markers2 = [];
		for (i=0;i<data.markers.length;i++){			
			SetMarker(map, data.markers[i].id, data.markers[i].type, data.markers[i].lat, data.markers[i].lng, data.markers[i].state);
		}
		clusters=new Array;
		for (i=0;i<data.clusters.length;i++){			
			SetCluster(map, data.clusters[i].count, data.clusters[i].lat, data.clusters[i].lng, i);  
		}
		setAllMap(map);
	});
}

function Cluster(LatLng, image, map, count) {

  // Initialize all properties.
  this.LatLng_ = LatLng;
  this.image_ = image;
  this.map_ = map;
  this.count_ = count;

  // Define a property to hold the image's div. We'll
  // actually create this div upon receipt of the onAdd()
  // method so we'll leave it null for now.
  this.div_ = null;

  // Explicitly call setMap on this overlay.
  this.setMap(map);
}
/**
 * onAdd is called when the map's panes are ready and the overlay has been
 * added to the map.
 */
Cluster.prototype.onAdd = function() {

  var div = document.createElement('div');
  div.style.borderStyle = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = '100%';
  img.style.height = '100%';
  img.style.position = 'absolute';
  div.appendChild(img);

  var cn = document.createElement('div');
  cn.style.borderStyle = 'none';
  cn.style.borderWidth = '0px';
  cn.style.position = 'absolute';
  cn.innerText=this.count_;
  cn.style.top="30px";
  cn.style.left="30px";
  cn.style.fontWeight="bold";

  div.appendChild(cn);

  this.div_ = div;

  // Add the element to the "overlayLayer" pane.
  var panes = this.getPanes();
  panes.overlayLayer.appendChild(div);
};

Cluster.prototype.draw = function() {

  // We use the south-west and north-east
  // coordinates of the overlay to peg it to the correct position and size.
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  // Retrieve the south-west and north-east coordinates of this overlay
  // in LatLngs and convert them to pixel coordinates.
  // We'll use these coordinates to resize the div.
  var center = overlayProjection.fromLatLngToDivPixel(this.LatLng_);
//console.log(center);
  // Resize the image's div to fit the indicated dimensions.
  var div = this.div_;
  div.style.left = center.x + 'px';
  div.style.top = center.y + 'px';
  div.style.width = '80px';
  div.style.height = '80px';
};

// The onRemove() method will be called automatically from the API if
// we ever set the overlay's map property to 'null'.
Cluster.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
  this.div_ = null;
};
