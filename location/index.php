<?php
    require_once('../php/classes/cart.php');
    require_once('../php/base/session.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../php/base/header.php'); ?>
    </head>

    <body>
        <?php include('../php/layout/navbar.php'); ?>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function initMap() {
                var cafe = { 
                    lat: 37.606415,
                    lng: -77.529009
                };
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 16,
                    center: cafe
                });

                var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h5 id="firstHeading" class="firstHeading">Glenn\'s Forest Cafe</h5>'+
                    '<div id="bodyContent">'+
                    'Mon-Fri: 8:00AM - 2:30PM<br><br>' +
                    '<span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>&nbsp;7202 Glen Forest Dr # 104, Richmond, VA 23226'+
                    '</div>'+
                    '</div>';

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: cafe,
                    map: map,
                    title: "Glenn's Forest Cafe"
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });

                infowindow.open(map,marker);
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSeh8dhxWazgSAuO1ftbvs2HZMhHSQvVs&callback=initMap"></script>
    </body>
</html>