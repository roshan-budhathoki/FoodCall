<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime location tracker</title>

    <!-- leaflet css -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    </script>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            width: 100%;
            height: 100vh;
        }
    </style>
</head>

<body>
<div id="map"></div>
</body>
</html>

<!-- leaflet js -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    let  latitude = "";
    let longitude = "";
    let client = "<?php $user_type = session('user_type'); echo strval($user_type); ?>";
    var pushers = new Pusher('ae514b3968d6bcb7077f', {
        cluster: 'ap2'
    });

    var channel = pushers.subscribe('my-channel');

    channel.bind('my-event', function(data) {
        console.log(data.message.sender);
        if("{{$driverId}}" == data.message.sender){
            latitude = data.message.lat;
            longitude = data.message.long;
            var lat = latitude;
            var long = longitude;

            if(marker) {
                map.removeLayer(marker)
            }

            if(circle) {
                map.removeLayer(circle)
            }

            marker = L.marker([lat, long])
            circle = L.circle([lat, long])

            var featureGroup = L.featureGroup([marker, circle]).addTo(map)

            map.fitBounds(featureGroup.getBounds())
            // console.log( "longitude : " + data.message.long + "latitude : " +  data.message.lat);
        }
    });
    pushers.logToConsole = true;

    // Map initialization
    var map = L.map('map').setView([14.0860746, 100.608406], 6);

    //osm layer
    var osm = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 15,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicm9zaGFuMjAiLCJhIjoiY2wyNHczcHMzMXlxeTNpcGV4ejA0MXMwaCJ9.xfVTx4k5PIYwa725MD7vBA'
    });
    osm.addTo(map);

    if(!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!")
    } else {
        setInterval(() => {
            if(client == "driver"){
                navigator.geolocation.getCurrentPosition(getPosition)
            }
        }, 1000);
    }

    var marker, circle;

    function getPosition(position){
// console.log(position)

// Lat and long is currently my position, but here the position should be of the driver browser which will then move the cursor 
        var lat = position.coords.latitude
        var long = position.coords.longitude
        var accuracy = position.coords.accuracy

        if(marker) {
            map.removeLayer(marker)
        }

        if(circle) {
            map.removeLayer(circle)
        }

        marker = L.marker([lat, long])
        circle = L.circle([lat, long], {radius: accuracy})

        var featureGroup = L.featureGroup([marker, circle]).addTo(map)

        map.fitBounds(featureGroup.getBounds())

        if("{{session('user_type')}}" == "driver"){
            $.ajax({
                url: '/updateLocation',
                method: 'POST',
                data : {"lat" : lat, "long": long,"sender": "{{session('user')}}","_token":"{{ csrf_token() }}"},
                success: function (response){

                }
            });
        }
    }
    // function getDriverPosition(position){
// console.log(position)

// Lat and long is currently my position, but here the position should be of the driver browser which will then move the cursor 
    //     var lat = latitude;
    //     var long = longitude;
    //     var accuracy = position.coords.accuracy

    //     if(marker) {
    //         map.removeLayer(marker)
    //     }

    //     if(circle) {
    //         map.removeLayer(circle)
    //     }

    //     marker = L.marker([lat, long])
    //     circle = L.circle([lat, long], {radius: accuracy})

    //     var featureGroup = L.featureGroup([marker, circle]).addTo(map)

    //     map.fitBounds(featureGroup.getBounds())


    // }

</script>
