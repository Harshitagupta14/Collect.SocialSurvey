function parse_location(x, y, location) {
    var addressComponents = location.address_components;
    var loc = {
        longitude: x,
        latitude: y,
        city: '',
        state: '',
        country: '',
        address: ''
    };
    console.log(addressComponents);
    for (var i = 0; i < addressComponents.length; i++) {
        var types = addressComponents[i].types


        if (types == "locality,political") {
            loc.city = addressComponents[i].long_name; // this should be your city, depending on where you are
        }
        if (types == "administrative_area_level_1,political") {
            loc.state = addressComponents[i].long_name;
            // this should be your city, depending on where you are
        }
        if (types == "country,political") {
            loc.country = addressComponents[i].long_name;
            // this should be your city, depending on where you are
        }

    }
    if (location.formatted_address != null) {
        loc.address = location.formatted_address;
    }
    console.log(loc);
    return loc;
}



function get_position(callback) {
    var geoOptions = {
        enableHighAccuracy: true,
        maximumAge: 30000,
        timeout: 27000
    };

    var geoError = function (error) {
        console.log('Error occurred. Error code: ' + error.code);
        // error.code can be:
        //   0: unknown error
        //   1: permission denied
        //   2: position unavailable (error response from location provider)
        //   3: timed out
    };

    navigator.geolocation.getCurrentPosition(callback, geoError, geoOptions);
}

function get_location(x, y, callback) {
    var request = new XMLHttpRequest();
    var latitude = x;
    var longitude = y;
    var method = 'GET';
    var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude + '&sensor=true&key=AIzaSyCMUrYLbYK6ZVvCzXraLrbRa2xEFE8HxEQ';
    var async = true;
    request.open(method, url, async);
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var data = JSON.parse(request.responseText);
            // alert(request.responseText); // check under which type your city is stored, later comment this line
            callback(data.results[0]);

        }
    };
    request.send();
}



function save_user_location(latitude, longitude, city, base_url) {
    data = 'latitude=' + latitude + '&longitude=' + longitude + '&city=' + city;
    var url = base_url + 'profile/save_user_location';
    post_ajax(url, data, function (stat) {
        var data = JSON.parse(stat);
        if (data.success == 'true') {
            console.log(data.status);
        } else {
            console.log(data.status);
        }

    });
}


