var oldMarker;
var map;
function initMap(map_div,latitude,longitude,starter_lat, starter_lng, editable) {
    var mapSelector = document.getElementById(map_div);
    var styles = [
        {
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [{
                "color": "#444444"
            }]
        },
        {
            "featureType": "landscape",
            "elementType": "all",
            "stylers": [{
                "color": "#f2f2f2"
            }]
        },
        {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        },
        {
            "featureType": "road",
            "elementType": "all",
            "stylers": [{
                "saturation": -100
            },
                {
                    "lightness": 45
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [{
                "visibility": "simplified"
            }]
        },
        {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [{
                "visibility": "off"
            }]
        },
        {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [{
                "visibility": "off"
            }]
        },
        {
            "featureType": "water",
            "elementType": "all",
            "stylers": [{
                "color": "#03a9f4"
            },
                {
                    "visibility": "on"
                }
            ]
        }
    ];

    // if (mapSelector) {
    //     map = new google.maps.Map(mapSelector, {
    //         center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
    //         zoom: 10,
    //         styles: styles
    //     });


    var myOptions = {
        zoom: 10,
        center: {lat: parseFloat(latitude), lng: parseFloat(longitude)},
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: styles,
        streetViewControl: false,
        mapTypeControl: false,
    };
    map = new google.maps.Map(mapSelector,
        myOptions);


    if(starter_lng)
    {
        placeMarker({lat: parseFloat(starter_lat), lng: parseFloat(starter_lng)});
    }else
    {
        map.setCenter({lat: parseFloat(latitude), lng: parseFloat(longitude)});


    }


    if(editable)
    {
        google.maps.event.addListener(map, 'click', function(event) {
            $("#latitude").val(event.latLng.lat().toFixed(3));
            $("#longitude").val(event.latLng.lng().toFixed(3));
            // document.getElementById('latitude').innerHTML = event.latLng.lat().toFixed(3);
            // document.getElementById('longitude').innerHTML = event.latLng.lng().toFixed(3);
            console.log(document.getElementById('longitude'));
            placeMarker(event.latLng);

        });
    }






    // }


        // // Create the initial InfoWindow.
        // var infoWindow = new google.maps.InfoWindow(
        //     {content: 'Click the map to get Lat/Lng!', position: {lat: parseFloat(latitude), lng: parseFloat(longitude)}});
        // infoWindow.open(map);
        // //
        // //
        // // Configure the click listener.
        // map.addListener('click', function(mapsMouseEvent) {
        //     // Close the current InfoWindow.
        //     infoWindow.close();
        //     // Create a new InfoWindow.
        //     infoWindow = new google.maps.InfoWindow({position: mapsMouseEvent.latLng});
        //     infoWindow.setContent(mapsMouseEvent.latLng.toString());
        //     infoWindow.open(map);
        //  });
        // }

    };
function placeMarker(location) {

    var marker = new google.maps.Marker({
        position: location,
        map: map,
        animation: google.maps.Animation.DROP,

    });



    if (oldMarker != undefined){
        oldMarker.setMap(null);
    }
    oldMarker = marker;
    map.setCenter(location);

}


// function add_marker(map_div, lat, lng, title,icon_url) {
//     var mapSelector = document.getElementById(map_div);
//     map = new google.maps.Map(mapSelector, {
//         center: {lat: parseFloat(lat), lng: parseFloat(lng)},
//         zoom: 10,
//         // styles: styles
//     });
//     var latLng = new google.maps.LatLng(lat, lng);
//
//     var infowindow = new google.maps.InfoWindow({
//         content: title
//     });
//
//     marker = new google.maps.Marker({
//         position: latLng,
//         title: title,
//         visible: true,
//         map: map,
//         icon: {
//             url: icon_url,
//         }
//     });
//
// //    marker.addListener('click', function (event) {
// //        infowindow.open(map, marker);
// //    });
//     google.maps.event.addListener(marker, 'click', (function (marker, infowindow) {
//         return function () {
//             infowindow.open(map, marker);
//         };
//     })(marker, infowindow));
// }

