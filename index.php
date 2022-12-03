
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body bgcolor="black">
    <p >hello map</p>
    <div id="map"></div>
    
  <!-- Code injected by live-server -->
<script type="text/javascript">
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script></body>
</html>
<script type="text/javascript">
  var map;
  function getData() {
    $.ajax({
    url: "map_api_wrapper.php",
    async: true,
    dataType: 'json',
    success: function (data) {
      console.log(data);
      //load map
      init_map(data);
    }
  });  
  }
  
  function init_map(data) {
        var map_options = {
            zoom: 14,
            center: new google.maps.LatLng(data['latitude'], data['longitude'])
          }
        map = new google.maps.Map(document.getElementById("map"), map_options);
       marker = new google.maps.Marker({
            map: map,
            position: new google.maps.LatLng(data['latitude'], data['longitude'])
        });
        infowindow = new google.maps.InfoWindow({
            content: data['formatted_address']
        });
        google.maps.event.addListener(marker, "click", function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);
    }
    

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=xxxxxxxxxxxxxxxxxxxxxx&callback=getData" async defer></script>