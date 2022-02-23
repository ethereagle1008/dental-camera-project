<x-admin-layout>
    <!--begin::Content-->
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
            .disable-print{
                display: none !important;
            }
            .show-print{
                display: flex !important;
            }
        }
    </style>
    <div class="content d-flex flex-column flex-column-fluid" id="">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">作業日報管理</h5>
                    <!--end::Title-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom mb-4">
                    <!--begin::Body-->
                    <div class="card-body">
                        <form id="work_report_form">
                            @csrf
                            <div class="form-group row">
                                <label class="col-form-label text-right col-lg-1 col-sm-12">現場名</label>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <input type="text" name="site_name" class="form-control" placeholder="現場名を入力してください。">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label class="col-form-label text-right col-lg-1 col-sm-12">日付</label>
                                <div class="col-lg-3 col-md-9 col-sm-12">
                                    <input type="text" class="form-control" id="kt_datepicker_1" name="report_date" readonly="readonly"
                                           value="{{date('m/d/Y')}}" placeholder="日付をご選択ください。" />
                                </div>
                                <button class="btn btn-success mr-2" id="btn_get_table">検　索</button>
                            </div>
                        </form>
                        <form id="work_report_detail_form" class="d-none">
                            @csrf
                            <input type="hidden" name="report_id" id="report_id">
                        </form>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">作業日報管理一覧
                                <span class="d-block text-muted pt-2 font-size-sm">選択した日付の作業報告を提出した場所と班一覧を示しています。</span>
                            </h3>
                        </div>
                        <div class="card-toolbar">
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <div id="work_report">

                        </div>

                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

    <!-- Modal-->
    <div class="modal fade" id="worKReportDetailModal" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 80vw">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">作業日報</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body" style="height: 600px;">
                    <div class="card card-custom w-100" id="section-to-print">
                        <div class="card-header pt-6">
                            <div class="row w-100 text-center py-3">
                                <div class="col-md-12 text-center">
                                    <h2>作　業　日　報　承　認　書</h2>
                                </div>
                            </div>
                            <div class="row w-100 disable-print">
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <p>
                                            <span>会社名: </span><span id="company_name"></span>
                                        </p>
                                        <p>
                                            <span>現場ID: </span><span id="site_code"></span>
                                        </p>
                                        <p>
                                            <span>現場名: </span><span id="site_name"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <p>
                                            <span>所属営業所: </span><span id="office_name"></span>
                                        </p>
                                        <p>
                                            <span>所属班名: </span><span id="team_name"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row w-100 mb-4 show-print" style="display:none;">
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <p>
                                            <span>会社名: </span><span id="company_name1"></span>
                                        </p>
                                        <p>
                                            <span>現場ID: </span><span id="site_code1"></span>
                                        </p>
                                        <p>
                                            <span>現場名: </span><span id="site_name1"></span>
                                        </p>
                                        <p class="pt-3">
                                            <span>所属営業所: </span><span id="office_name1"></span>
                                        </p>
                                        <p>
                                            <span>所属班名: </span><span id="team_name1"></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <div class="row">
                                            <div class="col-4"></div>
                                            <div class="col-8">
                                                <p>
                                                    <span>株式会社山大企画</span>
                                                </p>
                                                <p>
                                                    <span>{{date('Y年m月d日')}}({{dayWeek(date('w'))}})</span>
                                                </p>
                                                <div class="row">
                                                    <div class="col-7 text-center border">
                                                        <span>承認者</span>
                                                    </div>
                                                    <div class="col-5 text-center border">
                                                        <span>山大企画</span>
                                                    </div>
                                                </div>
                                                <div class="row" style="height: 80px">
                                                    <div class="col-7 text-center border">
                                                        <span></span>
                                                    </div>
                                                    <div class="col-5 text-center border align-middle">
                                                        <span class="align-middle" style="color: red"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header flex-wrap border-0 pt-6 pb-0">
                            <div class="card-title">
                                <h3 class="card-label">作業時間報告
                                    <span class="d-block text-muted pt-2 font-size-sm" id="report_date">2021年12月26日付分</span>
                                </h3>
                            </div>
                            <div class="card-toolbar disable-print">
                                <!--begin::Dropdown-->
                                <div class="dropdown dropdown-inline mr-2">
                                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="la la-download"></i>Export</button>
                                    <!--begin::Dropdown Menu-->
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <ul class="nav flex-column nav-hover">
                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2 pl-2">オプションを選択する:</li>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link" onclick="window.print()">
                                                    <i class="nav-icon la la-print"></i>
                                                    <span class="nav-text">PDF印刷</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a id="export-excel" href="{{route('master.work-report-export-excel', 1)}}" class="nav-link">
                                                    <i class="nav-icon la la-file-excel-o"></i>
                                                    <span class="nav-text">EXCEL出力</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--end::Dropdown Menu-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                        </div>
                        <div class="card-body py-0">
                            <!--begin: Datatable-->
                            <div id="work_report_detail">

                            </div>
                            <!--end: Datatable-->
                        </div>
                        <div class="card-header flex-wrap border-0 py-0" style="min-height: 30px;">
                            <div class="card-title">
                                <h3 class="card-label">作業内容報告</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!--begin: Datatable-->
                            <div id="work_report_content">
                                <p id="report" class="border p-2" style="min-height: 50px"></p>
                            </div>
                            <!--end: Datatable-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--end::Content-->
    <script>
        let work_report_table = '{{route('master.work-report-table')}}';
        let work_report_detail_table = '{{route('master.work-report-detail-table')}}';
        $(document).ready(function () {
            getTableData('work_report', work_report_table);

            $('#kt_datepicker_1').datepicker({
                rtl: false,
                todayHighlight: true,
                todayBtn: "linked",
                orientation: "bottom left",
                templates: {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'}
            });

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('work_report', work_report_table);
            });
        });
        $(document).on('click', '.work_report_detail', function () {
            $('#company_name').text($(this).parent().prev().prev().prev().prev().prev().text())
            $('#site_code').text($(this).parent().prev().prev().prev().prev().text())
            $('#site_name').text($(this).parent().prev().prev().prev().text())
            $('#office_name').text($(this).parent().prev().prev().text())
            $('#team_name').text($(this).parent().prev().text())
            $('#company_name1').text($(this).parent().prev().prev().prev().prev().prev().text())
            $('#site_code1').text($(this).parent().prev().prev().prev().prev().text())
            $('#site_name1').text($(this).parent().prev().prev().prev().text())
            $('#office_name1').text($(this).parent().prev().prev().text())
            $('#team_name1').text($(this).parent().prev().text())
            $('#report_date').text($(this).prev().val());
            $('#report_id').val($(this).prev().prev().val());
            $('#report').text($(this).prev().prev().prev().val());
            let report_id = $(this).prev().prev().val();
            let href = $('#export-excel').attr('href');
            let hrefs = href.split('export-excel');
            let new_url = hrefs[0] + 'export-excel' + '/' + report_id
            $('#export-excel').attr('href', new_url);
            getTableData('work_report_detail', work_report_detail_table, false);
            $('#worKReportDetailModal').modal('show');
        })
    </script>
</x-admin-layout>
