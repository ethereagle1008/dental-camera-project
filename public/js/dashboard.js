$(document).ready(function () {
    var x = document.getElementById("demo");
    $('.btn_arrive').click(function () {
        arriveLocation();
    })
    $('.btn_leave').click(function () {
        leaveLocation();
    })
    function arriveLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showArrivePosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
    function leaveLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showLeavePosition, showError);
        } else {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }

    function showArrivePosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            url: arrive,
            type:'post',
            data: {
                latitude : position.coords.latitude,
                longitude : position.coords.longitude
            },
            success: function (response) {
                var t = {message: "New order has been placed"};
                $.notify(t);
            },
            error: function () {

            }
        });
    }
    function showLeavePosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude +
            "<br>Longitude: " + position.coords.longitude;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            url: leave,
            type:'post',
            data: {
                latitude : position.coords.latitude,
                longitude : position.coords.longitude
            },
            success: function (response) {
                var t = {message: "New order has been placed"};
                $.notify(t);
            },
            error: function () {

            }
        });
    }

    function showError(error) {
        switch(error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "User denied the request for Geolocation."
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "Location information is unavailable."
                break;
            case error.TIMEOUT:
                x.innerHTML = "The request to get user location timed out."
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "An unknown error occurred."
                break;
        }
    }
})
