<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">前借申請</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">支払いマスター</a>
                            </li>
                            <li class="breadcrumb-item active">前借申請
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Advanced Search -->
        <section id="advanced-search-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">前借申請</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" id="work_report_form">
                                @csrf
                                <div class="row g-1 mb-md-1">
                                    <div class="col-md-6">
                                        <label class="form-label">氏名:</label>
                                        <input type="text" class="form-control dt-input dt-full-name" data-column="1" name="user_name"
                                               placeholder="氏名を入力してください。" data-column-index="0" />
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <button class="btn btn-success mr-2" id="btn_get_table">検　索</button>
                                </div>
                            </form>
                            <form id="work_report_detail_form" class="d-none">
                                @csrf
                                <input type="hidden" name="report_id" id="report_id">
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="card-datatable px-2" id="work_report">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Advanced Search -->
    </div>

    <script>
        let work_report_table = '{{route('master.pay-request-table')}}';
        let pay_status_status = '{{route('master.pay-request-status')}}';
        $(document).ready(function () {
            getTableData('work_report', work_report_table);

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('work_report', work_report_table);
            });
            $('#btn_export').click(function () {
                $('#btn_collection').show()
            })
        });
        $(document).on('click', '.btn_pay', function () {
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: pay_status_status,
                type:'post',
                data: {
                    id : id,
                    status:1
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
                        toastr.success("成功しました。");
                        window.location.reload()
                    }
                    else {
                        toastr.warning("失敗しました。");
                    }
                },
                error: function () {

                }
            });
        })
        $(document).on('click', '.btn_cancel', function () {
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: pay_status_status,
                type:'post',
                data: {
                    id : id,
                    status:2
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
                        toastr.success("成功しました。");
                        window.location.reload()
                    }
                    else {
                        toastr.warning("失敗しました。");
                    }
                },
                error: function () {

                }
            });
        })
    </script>
</x-admin-layout>
