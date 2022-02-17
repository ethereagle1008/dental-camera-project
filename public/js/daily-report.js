$(document).ready(function () {
    $('#btn_report').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            url: daily_report_post,
            type:'post',
            data: {
                site : $('#site').val(),
                message : $('#message').val()
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
