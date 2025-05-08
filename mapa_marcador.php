<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps AJAX + MySQL/PHP Example</title>
    
    <link type="text/css" rel="stylesheet" href="css/tramite.css"/>
    <?php
      $id=$_GET['id'];
    ?>
   
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAyD3xI06jyq98puUXIoSJqxQoWYlBrcQIwY81yLvVT6mzEGB2ExSWv0AAslk_JW2Jy6j725iwKtV23g"
            type="text/javascript"></script>
    
    <script type="text/javascript">
    //<![CDATA[ 

   

    var iconRed = new GIcon(); 
    iconRed.image = 'images/mm_20_red.png';
    iconRed.shadow = 'images/mm_20_shadow.png';
    iconRed.iconSize = new GSize(12, 20);
    iconRed.shadowSize = new GSize(22, 20);
    iconRed.iconAnchor = new GPoint(6, 20);
    iconRed.infoWindowAnchor = new GPoint(5, 1);

    var customIcons = iconRed;

    
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        //map.setCenter(new GLatLng(19.142898, -96.114235), 12);
        map.setCenter(new GLatLng(19.137546,-96.133289), 12);
        
        GDownloadUrl("lugares_pago.php?ban=0&id=<?php echo $id ?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          var resultados = document.getElementById("resultados");
          
          var salida='<ul>';
          for (var i = 0; i < markers.length; i++) 
          {
            salida += '<li>';  
            var name = markers[i].getAttribute("name");
            salida += '<strong>' + name + '</strong>'+':';
            var address = markers[i].getAttribute("address");
            var ref = markers[i].getAttribute("ref");
            var col_cp = markers[i].getAttribute("col_cp");
            var mpo_edo = markers[i].getAttribute("mpo_edo");
            salida +='<br>'+  address ;
            salida +='<br>'+  ref ;
            salida +='<br>'+  col_cp ;
            salida +='<br>'+  mpo_edo ;
            salida +='<br>';
            salida +='<br>';
            salida +='</li>';
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point,address,ref, col_cp, mpo_edo);
            map.addOverlay(marker);
          }
          
          resultados.innerHTML = salida;
        });
      }
    }

    function createMarker(point, address, ref, col_cp, mpo_edo) {
      var marker = new GMarker(point, customIcons);
      var html =  '<span style=" font: arial; font-size:12px; color:#666666">' +  address + "<br>" + ref + "<br>" + col_cp +  "<br>" + mpo_edo + '</span>';
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }
    //]]>
  </script>

  </head>
    
  <body id="body_mapa" onload="load()" onunload="GUnload()">
    <div id="map"> </div> 
    <div id="resultados"></div>
  </body>
 </html>