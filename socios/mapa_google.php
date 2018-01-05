<?php 
	include("config/conexion.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Info windows</title>
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>

// This example displays a marker at the center of Australia.
// When the user clicks the marker, an info window opens.

function initMap() {
  var uluru = {lat: <?php echo $business_latitud;?>, lng: <?php echo $business_longitud;?>};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: uluru
  });

  var contentString = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $business_name;?></h1>'+
      '<div id="bodyContent">'+
      '<p><b>Dirección:</b> <?php echo $business_address;?><br><b>Teléfono:</b> <?php echo $business_phone;?>' +
      '<br><b>E-mail:</b> <?php echo $business_email; ?><br> '+
      '<p><small>Desarrollado por: <a href="http://obedalvarado.pw/">'+
      'Obed alvarado</a></small> '+
      '&copy 2016</p>'+
      '</div>'+
      '</div>';

  var infowindow = new google.maps.InfoWindow({
    content: contentString
  });

  var marker = new google.maps.Marker({
    position: uluru,
    map: map,
    title: '<?php echo $business_name;?>'
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}

    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvFBBkoO-VEUguF9BrSYvOPFGA6xNAmsE&signed_in=true&callback=initMap"></script>
  </body>
</html>