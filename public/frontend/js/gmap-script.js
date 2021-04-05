
/**
 * It outputs a styled (back and white) map on the given dom element id
 *
 * @param {string}  dom_el_id the id of the html dom element to mount the map on
 * @param {float}   lat the lattidue of the place
 * @param {float}   lng the longitude of the place
 * @param {string}   marker_icon the path to map marker icon
 *
 * @return void
 * */

function initMap(dom_el_id, lat, lng, marker_icon) {
    // add the fallback, we could use default parameterr but IE does not support default parameters
    if (typeof dom_el_id === 'undefined') {
        dom_el_id = 'map';
    }
    if (typeof lat === 'undefined') {
        lat = 40.728157;
    }
    if (typeof lng === 'undefined') {
        lng = -74.077644;
    }
    if (typeof marker_icon === 'undefined') {
        marker_icon = '../images/map-marker.png';
    }



    let lat_lng = {
        lat: lat,
        lng: lng
    }; // lattitude and longitude of your place
    let element_to_mount_map = document.getElementById(dom_el_id); // get the dom element using the given ID
    if("undefined" === typeof google){
        return; // if google map does not load in the local, then vail early.
    }
    let map = new google.maps.Map(
        element_to_mount_map, {
            zoom: 13,
            center: lat_lng,
            styles: [
                {
                    "featureType" : "road",
                    "stylers" : [
                        {"color" : "#ffffff"}
                    ]
                }, {
                    "featureType" : "water",
                    "stylers" : [
                        {"color" : "#e9e9e9"}
                    ]
                }, {
                    "featureType" : "landscape",
                    "stylers" : [
                        {"color" : "#f5f5f5"}
                    ]
                }, {
                    "elementType" : "labels.text.fill",
                    "stylers" : [
                        {"color" : "transparent"}
                    ]
                }, {
                    "featureType" : "poi",
                    "stylers" : [
                        {"color" : "#fefefe"}
                    ]
                }, {
                    "elementType" : "labels.text",
                    "stylers" : [
                        {"saturation" : 1},
                        {"weight" : 0.1},
                        {"color" : "#737980"}
                    ]
                }
            ]
        });

    new google.maps.Marker({
        position: lat_lng,
        map: map,
        icon: marker_icon,
        animation: google.maps.Animation.BOUNCE
    });
}