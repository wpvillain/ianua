/** 
 * ===================================================================
 * map js
 *
 * ------------------------------------------------------------------- 
 */

(function($) {

	/*---------------------------------------------------- */
	/* Map
	------------------------------------------------------ */
	function initMap() {
	var latitude = 14.549072,
		 longitude = 121.046958,
		 map_zoom = 15,		 
		 main_color = '#d8ac00',
		 saturation_value = -30,
		 brightness_value = 5,
		 marker_url = null,
		 winWidth = $(window).width(),
		 imgPath	=	path.image;

   // marker url
	if ( winWidth > 480 ) {
			marker_url = imgPath+'/icon-location@2x.png';                    
   } else {
      marker_url = imgPath+'/images/icon-location.png';            
   }	 

	// map style
	var style = [ 
		{
			// set saturation for the labels on the map
			elementType: "labels",
			stylers: [
				{ saturation: saturation_value }
			]
		},  
	   {	// poi stands for point of interest - don't show these lables on the map 
			featureType: "poi",
			elementType: "labels",
			stylers: [
				{visibility: "off"}
			]
		},
		{
			// don't show highways lables on the map
	      featureType: 'road.highway',
	      elementType: 'labels',
	      stylers: [
	         { visibility: "off" }
	      ]
	   }, 
		{ 	
			// don't show local road lables on the map
			featureType: "road.local", 
			elementType: "labels.icon", 
			stylers: [
				{ visibility: "off" } 
			] 
		},
		{ 
			// don't show arterial road lables on the map
			featureType: "road.arterial", 
			elementType: "labels.icon", 
			stylers: [
				{ visibility: "off" }
			] 
		},
		{
			// don't show road lables on the map
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [
				{ visibility: "off" }
			]
		}, 
		// style different elements on the map
		{ 
			featureType: "transit", 
			elementType: "geometry.fill", 
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		}, 
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.government",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.sport_complex",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.attraction",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.business",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "transit",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "transit.station",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "landscape",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
			
		},
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "road.highway",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		}, 
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		}
	];
		
	// map options
	var map_options = {

      	center: new google.maps.LatLng(latitude, longitude),
      	zoom: 15,
      	panControl: false,
      	zoomControl: false,
        mapTypeControl: false,
      	streetViewControl: false,
      	mapTypeId: google.maps.MapTypeId.ROADMAP,
      	scrollwheel: false,
      	styles: style

    	};

   // inizialize the map
		
	var map = new google.maps.Map(document.getElementById('map_canvas'), map_options);
		
	
	// add a custom marker to the map				
	var marker = new google.maps.Marker({
		 	position: new google.maps.LatLng(latitude, longitude),
		 	map: map,
		 	visible: true,
		 	icon: marker_url});

	// add custom buttons for the zoom-in/zoom-out on the map
	function CustomZoomControl(controlDiv, map) {
	
		// grap the zoom elements from the DOM and insert them in the map 
	 	var controlUIzoomIn= document.getElementById('map-zoom-in'),
		  	 controlUIzoomOut= document.getElementById('map-zoom-out');

		controlDiv.appendChild(controlUIzoomIn);
		controlDiv.appendChild(controlUIzoomOut);

		// Setup the click event listeners and zoom-in or out according to the clicked element
		google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
			map.setZoom(map.getZoom()+1);
		});
		google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
			map.setZoom(map.getZoom()-1);
		});
			
	}

	var zoomControlDiv = document.createElement('div');
	var zoomControl = new CustomZoomControl(zoomControlDiv, map);

	// insert the zoom div on the top right of the map
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(zoomControlDiv);
	}

	/* We initialize google maps only if window is loaded and map_canvas element exists on that page else we will get TypeError: Cannot read property 'offsetWidth' of null */
	
	if (typeof(window.google) !== 'undefined' && google.maps ) {
  google.maps.event.addDomListener(window, 'load', function() {

		if($('#map_canvas').length > 0){	
			initMap();
		}
    
  }); 
}

	

})(jQuery);