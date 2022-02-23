$(document).ready(function () {
    $('#btn_request').click(function () {
        let price = $('#price').val();
        let limit = $('#limit').val();
        console.log(price, limit);
        if(price == 0 || price > parseInt(limit)){
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

            toastr.warning("前払い金額を正確に入力してください。");
            return;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': token
            }
        });
        $.ajax({
            url: pay_request_post,
            type:'post',
            data: {
                payment : $('#price').val()
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
                    toastr.success("前払い要請を転送しました。");
                }
                else {
                    toastr.warning("失敗しました。");
                }
            },
            error: function () {

            }
        });
    })
})
