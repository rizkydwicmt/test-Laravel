<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="Author" content="Alim Sumarno">
    <title>MOOC Users Online Maps</title>
    <link href="//fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>function initMap() { }</script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>

</head>

<body>
    <h3 align="center" id="jonliall"></h3>
    <div id="log_online_spadaindonesia" style="height: 100vh; position: relative;"
        class="map map-home leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom">
    </div>


    <script>

        var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }
        var ID_SP = '{{$id}}';
        $(function () {
            function sedapmalam(div, rs) {
                $('#' + div).html('');
                var mymap = L.map(div).setView([-2.548926,118.0148634], 5);
                MY_MAPS = mymap;

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1Ijoicml6a3lkd2ljbXQiLCJhIjoiY2t4c3FqeGphNHoyaDJwb2s1cnlkajJ1YyJ9.ZnDcF3gm4M9MurANvHlufA', {
                    maxZoom: 20,
                    attribution: '<a href="http://mooc.unair.ac.id/" target="_blank">MOOC</a> | by <a href="https://www.linkedin.com/in/rizky-dwi-aditya/" target="_blank">Rizky Dwi Aditya</a> | Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(mymap);
                var icon_loc = L.icon({
                    iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
                    iconSize: [20, 30]
                });
                $.each(rs, function (a, r) {
                    var level = r.level;
                    var latlng = r.lokasi;
                    var lat = 0;
                    var lng = 0;
                    if (latlng) {
                        var split = latlng.split(',');
                        lat = parseNum(split[0].trim());
                        lng = parseNum(split[1].trim());
                    }
                    L.marker([lat, lng], { icon: icon_loc }).addTo(mymap).bindPopup('<div align=center><img style="border-radius: 50%; width:50px" src="' + r.foto + '"><br><strong>' + r.nama + '</strong></div>').openPopup();
                });
                mymap.setView([-2.548926,118.0148634], 5);
            }
            function parseNum(val) {
                return (typeof val == null) ? 0.0 : parseFloat(val);
            }
            
            $.getJSON("//apispada.kemdikbud.go.id/rekap_lms/" + ID_SP + '.json', function (data) {
                sedapmalam('log_online_spadaindonesia', data.useronline);
            });
        });
    </script>

</body>

</html>