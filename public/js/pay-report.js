$(document).ready(function () {
    $('#btn_request').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            url: pay_request_post,
            type:'post',
            data: {
                price : $('#price').val()
            },
            success: function (response) {
                var t = {message: "New order has been placed"};
                $.notify(t);
            },
            error: function () {

            }
        });
    })
})
