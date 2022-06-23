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
                top: 0 !important;
                box-shadow: none !important;
            }
            .disable-print{
                display: none !important;
            }
            .show-print{
                display: flex !important;
            }
        }
    </style>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">作業日報管理</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">作業マスター</a>
                            </li>
                            <li class="breadcrumb-item active">作業日報管理
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
                            <h4 class="card-title">作業日報管理</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" id="work_report_form">
                                @csrf
                                <div class="row g-1 mb-md-1">
                                    <div class="col-md-6">
                                        <label class="form-label">現場名:</label>
                                        <select class="form-select" name="site_name">
                                            <option></option>
                                            @foreach($sites as $item)
                                                <option value="{{$item->name}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">日付:</label>
                                        <input type="text" id="birthday" class="form-control flatpickr-basic" name="report_date" placeholder="YYYY-MM-DD"
                                               data-column="2" value="{{date('Y-m-d')}}"  data-column-index="1"/>
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

    <!-- Modal-->
    <div class="modal fade text-start" id="worKReportDetailModal" tabindex="-1" aria-labelledby="worKReportDetailModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">作業日報</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div class="card card-custom w-100 position-relative" id="section-to-print">
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
                                    <button id="btn_export" class="dt-button buttons-collection btn btn-outline-secondary dropdown-toggle me-2" data-toggle="collapse"
                                            data-target="#btn_collection" aria-controls="collapse" aria-haspopup="true" aria-expanded="false">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share font-small-4 me-50">
                                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                                <polyline points="16 6 12 2 8 6"></polyline>
                                                <line x1="12" y1="2" x2="12" y2="15"></line>
                                            </svg>Export
                                        </span>
                                    </button>
                                    <div class="dt-button-collection collapse" id="btn_collection" style="top: 52px; left: 724.703px; display: none">
                                        <div role="menu">
                                            <a href="#" onclick="window.print()" class="dt-button buttons-print dropdown-item" tabindex="0"
                                               aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-printer font-small-4 me-50"><polyline
                                                            points="6 9 6 2 18 2 18 9"></polyline><path
                                                            d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect
                                                            x="6" y="14" width="12" height="8"></rect></svg>PDF印刷</span>
                                            </a>
                                            <a id="export-excel" href="{{route('master.work-report-export-excel', 1)}}"
                                               class="dt-button buttons-excel buttons-html5 dropdown-item"
                                               tabindex="0" aria-controls="DataTables_Table_0" type="button"><span><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="feather feather-file font-small-4 me-50"><path
                                                            d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline
                                                            points="13 2 13 9 20 9"></polyline></svg>EXCEL出力</span>
                                            </a>
                                        </div>
                                    </div>
                                    <!--begin::Dropdown Menu-->
                                {{--                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">--}}
                                {{--                                        <ul class="nav flex-column nav-hover">--}}
                                {{--                                            <li class="nav-header font-weight-bolder text-uppercase text-primary pb-2 pl-2">オプションを選択する:</li>--}}
                                {{--                                            <li class="nav-item">--}}
                                {{--                                                <a href="#" class="nav-link" onclick="window.print()">--}}
                                {{--                                                    <i class="nav-icon la la-print"></i>--}}
                                {{--                                                    <span class="nav-text">PDF印刷</span>--}}
                                {{--                                                </a>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li class="nav-item">--}}
                                {{--                                                <a id="export-excel" href="{{route('master.work-report-export-excel', 1)}}" class="nav-link">--}}
                                {{--                                                    <i class="nav-icon la la-file-excel-o"></i>--}}
                                {{--                                                    <span class="nav-text">EXCEL出力</span>--}}
                                {{--                                                </a>--}}
                                {{--                                            </li>--}}
                                {{--                                        </ul>--}}
                                {{--                                    </div>--}}
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
                        <div class="card-header flex-wrap border-0 pb-0 pt-3" style="min-height: 30px;">
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

    <div class="modal fade text-start" id="worKReportEditModal" tabindex="-1" aria-labelledby="worKReportEditModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">作業日報</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" >
                    <div class="card card-custom w-100 position-relative" id="section-to-print">
                        <div class="card-header pt-6">
                            <div class="row w-100 text-center py-3">
                                <div class="col-md-12 text-center">
                                    <h2>作　業　日　報　承　認　書</h2>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-1 mb-md-1">
                                <form id="report_detail_form">
                                    @csrf
                                    <div class="col-md-12">
                                        <label class="form-label">現場名:</label>
                                        <select class="form-select" name="site_id" id="site">
                                            <option></option>
                                            @foreach($sites as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" id="report_id_edit" name="report_id">
                                    <div class="col-md-12">
                                        <label class="form-label">日報内容:</label>
                                        <textarea id="report_content" class="form-control" name="report_content" placeholder="YYYY-MM-DD"
                                               data-column="2" value="{{date('Y-m-d')}}"  data-column-index="1"></textarea>
                                    </div>
                                    <button id="btn_edit_report" class="btn btn-primary waves-effect waves-float waves-light">変更</button>
                                </form>

                            </div>
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
        let work_report_detail_edit = '{{route('master.work-report-detail-edit')}}';
        $(document).ready(function () {
            getTableData('work_report', work_report_table);
            $('.flatpickr-basic').flatpickr();

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('work_report', work_report_table);
            });
            $('#btn_export').click(function () {
                $('#btn_collection').show()
            })
            $('#btn_edit_report').click(function (e) {
                e.preventDefault();
                saveForm('report_detail_form', work_report_detail_edit, true);
            })
        });
        $(document).on('click', '.btn_edit', function () {
            $('#report_content').text($(this).prev().prev().prev().prev().val());
            $("#site").val($(this).prev().prev().prev().prev().prev().val());
            $("#report_id_edit").val($(this).prev().prev().prev().val());
            //$("#site select").val($(this).prev().prev().prev().prev().prev().val()).change();
            $('#worKReportEditModal').modal('show');
        });
        $(document).on('click', '.work_report_detail', function () {
            $('#company_name').text($(this).parent().prev().prev().prev().prev().prev().prev().text())
            $('#site_code').text($(this).parent().prev().prev().prev().prev().prev().text())
            $('#site_name').text($(this).parent().prev().prev().prev().prev().text())
            $('#office_name').text($(this).parent().prev().prev().prev().text())
            $('#team_name').text($(this).parent().prev().prev().text())
            $('#company_name1').text($(this).parent().prev().prev().prev().prev().prev().prev().text())
            $('#site_code1').text($(this).parent().prev().prev().prev().prev().prev().text())
            $('#site_name1').text($(this).parent().prev().prev().prev().prev().text())
            $('#office_name1').text($(this).parent().prev().prev().prev().text())
            $('#team_name1').text($(this).parent().prev().prev().text())
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
