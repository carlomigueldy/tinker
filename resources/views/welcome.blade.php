<!DOCTYPE html>
<html>
<head>
    <title>Simple Leaflet Map</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7/leaflet.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css"/>
    <style>
    body {
        margin: 0;
    }
    html, body, #map { 
        height: 100%;
    }
    </style>
</head>
<body>
    <div id="map"></div>

    <script src="http://cdn.leafletjs.com/leaflet-0.7/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-geometryutil@0.9.1/src/leaflet.geometryutil.min.js"></script>
    <script>
        var map = L.map('map').setView([-41.2858, 174.78682], 14);
        mapLink = 
            '<a href="http://openstreetmap.org">OpenStreetMap</a>';
        L.tileLayer(
            'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
            }).addTo(map);

        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);

        var drawControl = new L.Control.Draw({
            draw: {
                circle: false,
                circlemarker: false,
            },
            edit: {
                featureGroup: drawnItems,
                edit: false,
            }
        });
        map.addControl(drawControl);

        // Take the coordinates [lat, lng] from the recently drawn object
        map.on('draw:created', function (e) {
            var type = e.layerType,
                layer = e.layer;
            drawnItems.addLayer(layer);

            if(type == 'polygon' || type == 'rectangle') {
                var coordinates = (JSON.stringify(layer.getLatLngs().map(function(point) {
                        return ([point.lat, point.lng]);  
                    })
                ));

                console.log(coordinates);
            }

            if (type == 'marker') {
                var lat = layer.getLatLng().lat;
                var lng = layer.getLatLng().lng;

                console.log("Latitude: " + lat + " | Longitude: " + lng);
            }

        });

    </script>
</body>
</html>
