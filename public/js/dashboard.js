let site_id = '';
$(document).ready(function () {
    var x = document.getElementById("demo");
    $('.btn_arrive').click(function () {
        console.log($('#site').val());
        if($('#site').val() == ''){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.warning("現場を選択してください。");
            return;
        }
        site_id = $('#site').val();
        Swal.fire({
            title: "出勤報告をしますか。",
            text: "現在のアドレスが一緒にアップロードされます。",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "はい",
            cancelButtonText: "キャンセル"
        }).then(function(result) {
            if (result.value) {
                //sendShift('place', 'arrive');
                arriveLocation();
            }
        });

    })
    $('.btn_leave').click(function () {
        if($('#site').val() == ''){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.warning("現場を選択してください。");
            return;
        }
        site_id = $(this).data('id');
        Swal.fire({
            title: "退勤報告をしますか。",
            text: "現在のアドレスが一緒にアップロードされます。",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "はい",
            cancelButtonText: "キャンセル"
        }).then(function(result) {
            if (result.value) {
                //sendShift('place', 'leave');
                leaveLocation();
            }
        });

    })
})

function arriveLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(sendArrivePosition, showError);
    } else {
        alert('位置情報を得られません。')
    }
}
function leaveLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(sendLeavePosition, showError);
    } else {
        //x.innerHTML = "Geolocation is not supported by this browser.";
        alert('位置情報を得られません。')
    }
}

function sendArrivePosition(position) {
    getPlaceName(position, 'arrive');
}
function sendLeavePosition(position) {
    getPlaceName(position, 'leave');
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert('ユーザがジオロケーションの要求を拒否しました。')
            //x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            alert('ロケーション情報を使用できません。')
            //x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            alert('ロケーションを取得する要求がタイムアウトしました。')
            //x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            alert('位置情報を得られません。')
            //x.innerHTML = "An unknown error occurred."
            break;
    }
}

function getPlaceName(position, type) {
    //sendShift('place', type);
    let latlng = {
        lat: parseFloat(position.coords.latitude),
        lng: parseFloat(position.coords.longitude),
    };
    let geocoder = new google.maps.Geocoder();
    geocoder
        .geocode({ location: latlng })
        .then((response) => {
            if (response.results[0]) {
                console.log(response);
                let place = response.results[0].address_components[5].long_name + response.results[0].address_components[4].long_name + response.results[0].address_components[3].long_name
                    + response.results[0].address_components[2].long_name;
                sendShift(place, type);
            }
        })
        .catch((e) => window.alert("Geocoder failed due to: " + e));
}

function sendShift(place, type){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    $.ajax({
        url: shift_post,
        type:'post',
        data: {
            place: place,
            type: type,
            site_id: site_id
        },
        success: function (response) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            if(response.status == true){
                if(type == 'arrive'){
                    $('#btn_arrive')[0].disabled = true;
                    $('#site')[0].disabled = true;
                    toastr.success("出勤報告をしました。");
                    window.location.reload();
                }
                else{
                    $('#btn_leave')[0].disabled = true;
                    toastr.success("退勤報告をしました。");
                    window.location.reload();
                }
            }
            else {
                toastr.warning("失敗しました。");
            }

        },
        error: function () {

        }
    });
}
