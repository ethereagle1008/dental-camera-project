function getTableData(id, url, draw = true) {
    let index = '#' + id;
    let tableIndex = '#' + id + '_table';
    let formIndex = '#' + id + '_form'
    var paramObj = new FormData($(formIndex)[0]);
    $.ajax({
        url: url,
        type:'post',
        data: paramObj,
        contentType: false,
        processData: false,
        success: function (response) {
            $(index).html(response);
            if(draw){
                var t = $(tableIndex);
                t.DataTable({
                    responsive: !0,
                    dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                    lengthMenu: [5, 10, 25, 50],
                    pageLength: 10,
                    language: {
                        "decimal":        "",
                        "emptyTable":     "現在ありません",
                        "info":           "_TOTAL_個の資料の中で_START_~_END_が現示されます。",
                        "infoEmpty":      "0~0の0を表示。",
                        "infoFiltered":   "(filtered from _MAX_ total entries)",
                        "infoPostFix":    "",
                        "thousands":      ",",
                        "lengthMenu":     " _MENU_ ",
                        "loadingRecords": "ロード中...",
                        "processing":     "処理中...",
                        "search":         "検索:",
                        "zeroRecords":    "一致する検索資料がありません。",
                        "paginate": {
                            "first":      "初めに",
                            "last":       "最後",
                            "next":       "次へ",
                            "previous":   "前へ"
                        },
                    },
                });
            }
        },
        error: function () {

        }
    });
}
function saveForm(index, url, reload=false) {
    console.log(index);
    let id = '#' + index;
    console.log($(id).valid())
    if($(id).valid()){
        var paramObj = new FormData($(id)[0]);
        console.log(paramObj);
        $.ajax({
            url: url,
            type: 'post',
            data: paramObj,
            contentType: false,
            processData: false,
            success: function(response){
                console.log(response);
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
                    toastr.success("成功しました。");
                }
                else {
                    toastr.warning("失敗しました。");
                }


            },
        });
    }
}
