<x-admin-layout>
    <!--begin::Content-->
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">勤怠承認管理</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">作業マスター</a>
                            </li>
                            <li class="breadcrumb-item active">出勤管理
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
                            <h4 class="card-title">出勤管理</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-6">
                                    <form class="dt_adv_search" method="POST" id="work_report_form">
                                        @csrf
                                        <div class="row g-1 mb-md-1">
                                            <div class="col-md-6">
                                                <label class="form-label">日選択:</label>
                                                <input type="text" class="form-control flatpickr-basic" id="report_date_2"
                                                    name="report_date" placeholder="YYYY-MM-DD" data-column="2"
                                                    value="{{ date('Y-m-d') }}" data-column-index="1" />

                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">現場名:</label>
                                                <select class="form-select" name="site_name">
                                                    <option></option>
                                                    @foreach ($sites as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row g-1 mb-md-1">
                                            <div class="col-md-12 text-right" style="text-align: right">
                                                <button class="btn btn-success mr-2" id="btn_get_table">検　索</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <div class="row g-1 mb-md-1">
                                        <div class="col-md-6">
                                            <label class="form-label">日選択:</label>
                                            <input type="text" id="report_date_1"
                                                class="form-control flatpickr-basic" name="report_date"
                                                placeholder="YYYY-MM-DD" data-column="2" value="{{ date('Y-m-d') }}"
                                                data-column-index="1" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="fp-range">週間選択</label>
                                            <input type="text" id="range" class="form-control flatpickr-range"
                                                placeholder="YYYY-MM-DD to YYYY-MM-DD" name="range" required />
                                        </div>
                                    </div>
                                    <div class="row g-1 mb-md-1">
                                        <div class="col-md-6 text-center">
                                            <a class="btn btn-success mr-2"
                                                href="{{ route('master.work-report-export-down') }}?report_date={{ date('Y-m-d') }}"
                                                id="btn_down_table" style="float: right">業務日報報告書</a>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <a class="btn btn-success mr-2" id="btn_down_list">承認一覧表</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="work_report_detail_form" class="d-none">
                                @csrf
                                <input type="hidden" name="site_id" id="site_id">
                                <input type="hidden" name="report_date" id="report_date_form">
                                <input type="hidden" name="report_name" id="report_name"
                                    value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="card-datatable px-2" id="work_report">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <input type="hidden" id="contract_type" value="{{ \Illuminate\Support\Facades\Auth::user()->contract_type }}">
        <!--/ Advanced Search -->
    </div>

    <!-- Modal-->
    <div class="modal fade text-start" id="worKReportDetailModal" tabindex="-1" aria-labelledby="worKReportDetailModal"
        data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1000px">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">出勤承認</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom w-100 position-relative" id="section-to-print">
                        <div class="card-header pt-6">
                            <div class="row w-100 disable-print">
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <p>
                                            <span>会社名: </span><span id="company_name"></span>
                                        </p>
                                        <p>
                                            <span>現場ID: </span><span id="site_code"></span>
                                        </p>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-label">
                                        <p>
                                            <span>現場名: </span><span id="site_name"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-header flex-wrap border-0 pt-0 pb-0">
                            <div class="card-title">
                                <h5 class="card-label">出勤報告
                                    <span class="d-block text-muted pt-2 font-size-sm"
                                        id="report_date">2021年12月26日付分</span>
                                </h5>
                            </div>
                        </div>
                        <div class="card-body py-0 pb-2">
                            <!--begin: Datatable-->
                            <div id="work_report_detail">

                            </div>
                            <!--end: Datatable-->
                        </div>
                    </div>
                    <button class="mt-0 btn btn-primary waves-effect waves-float waves-light mr-2"
                        style="float:right; margin-left: 10px" data-bs-dismiss="modal" aria-label="Close">閉じる
                    </button>
                    {{-- <button id="btn_confirm_report" class="mt-0 btn btn-primary waves-effect waves-float waves-light"
                            style="float:right;" >承認
                    </button> --}}

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-start" id="worKReportStatusModal" tabindex="-1"
        aria-labelledby="worKReportStatusModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">出勤承認者</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card card-custom w-100 position-relative" id="section-to-print">
                        <div class="card-body">
                            <div class="row g-1 mb-md-1">
                                <div class="col-md-12">
                                    <label class="form-label">承認者名:</label>
                                    <input type="text" class="form-control" id="report_name_1" />
                                </div>
                                <button id="btn_edit_report1"
                                    class="btn btn-primary waves-effect waves-float waves-light">承認
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content-->
    <script>

        let work_report_table = '{{ route('master.work-report-table') }}';
        let work_report_status = '{{ route('master.work-report-status') }}';
        let work_report_detail_table = '{{ route('master.work-report-detail-table') }}';
        let work_report_detail_edit = '{{ route('master.work-report-detail-edit') }}';
        let work_report_export_down = '{{ route('master.work-report-export-down') }}';
        let work_report_down_list = '{{ route('master.work-report-down-list') }}';
        $(document).ready(function() {
            getTableData('work_report', work_report_table);
            $('.flatpickr-basic').flatpickr();
            $('.flatpickr-range').flatpickr({
                mode: 'range'
            });

            $('#report_date_1').change(function(e) {
                let new_url = work_report_export_down + '?report_date=' + $(this).val()
                $('#btn_down_table').attr('href', new_url);
            });
            $('#range').change(function(e) {
                let new_url = work_report_down_list + '?report_date=' + $(this).val()
                $('#btn_down_list').attr('href', new_url);
            });
            $('#btn_get_table').click(function(e) {
                e.preventDefault();
                getTableData('work_report', work_report_table);
            });
            $('#btn_export').click(function() {
                $('#btn_collection').show()
            })
            $('#btn_edit_report').click(function(e) {
                e.preventDefault();
                saveForm('report_detail_form', work_report_detail_edit, true);
            })

            $('#btn_confirm_report').click(function(e) {
                e.preventDefault();
                if ($("#contract_type").val()) {
                    $('#worKReportStatusModal').modal('show');
                } else {
                    saveForm('work_report_detail_form', work_report_status, true);
                }
            })
            $('#btn_edit_report1').click(function(e) {
                e.preventDefault();
                $("#report_name").val($("#report_name_1").val());
                saveForm('work_report_detail_form', work_report_status, true);
            })
            // $('#btn_down_table').click(function (e){
            //     e.preventDefault();
            //     let id = '#work_report_form';
            //     if($(id).valid()){
            //         var paramObj = new FormData($(id)[0]);
            //         console.log(paramObj);
            //         $.ajax({
            //             url: work_report_export_down,
            //             type: 'post',
            //             data: paramObj,
            //             contentType: false,
            //             processData: false,
            //             success: function(response){
            //                 console.log(response);
            //             },
            //         });
            //     }
            // });
        });
        $(document).on('click', '.confirm_report', function() {
            console.log("d");
            $('#site_id').val($(this).prev().prev().prev().val());
            $('#report_date_form').val($('#report_date_1').val())
            if ($("#contract_type").val()) {
                $('#worKReportStatusModal').modal('show');
            } else {
                saveForm('work_report_detail_form', work_report_status, true);
            }
        })
        $(document).on('click', '.btn_edit', function() {
            $('#report_content').text($(this).prev().prev().prev().prev().val());
            $("#site").val($(this).prev().prev().prev().prev().prev().val());
            $("#report_id_edit").val($(this).prev().prev().prev().val());
            $('#worKReportEditModal').modal('show');
        });
        $(document).on('click', '.work_report_detail', function() {
            $('#company_name').text($(this).parent().prev().prev().prev().prev().prev().prev().prev().text())
            $('#site_code').text($(this).parent().prev().prev().prev().prev().prev().prev().text())
            $('#site_name').text($(this).parent().prev().prev().prev().prev().prev().text())
            console.log($(this).parent().prev().prev().text())
            if ($("#contract_type").val()) {
                if ($(this).parent().prev().prev().prev().prev().text() != '') {
                    $('#btn_confirm_report').prop('disabled', true);
                } else {
                    $('#btn_confirm_report').prop('disabled', false);
                }
            } else {
                if ($(this).parent().prev().prev().text() != '') {
                    $('#btn_confirm_report').prop('disabled', true);
                } else {
                    $('#btn_confirm_report').prop('disabled', false);
                }
            }

            console.log($(this).parent().prev().prev().prev().prev().text())

            $('#report_date').text($(this).prev().val());
            $('#site_id').val($(this).prev().prev().val());
            $('#report_date_form').val($('#report_date_2').val())
            getTableData('work_report_detail', work_report_detail_table, false);
            $('#worKReportDetailModal').modal('show');
        })
    </script>
</x-admin-layout>
