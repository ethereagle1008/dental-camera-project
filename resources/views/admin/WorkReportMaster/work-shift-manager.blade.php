<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">勤怠管理</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">作業マスター</a>
                            </li>
                            <li class="breadcrumb-item active">勤怠管理
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
                            <h4 class="card-title">勤怠管理</h4>
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
    <div class="modal fade text-start" id="worKShiftChangeModal" tabindex="-1" aria-labelledby="worKShiftChangeModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">作業時間詳細</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="work_detail_change">
                    @csrf
                    <input type="hidden" name="shift_id" id="shift_id">
                    <div class="modal-body">
                        <div class="card-custom w-100 position-relative" id="section-to-print">
                            <div class="card-header pb-0">
                                <div class="row text-center">
                                    <div class="col-md-12 text-center">
                                        <h2>作業形態決定</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header flex-wrap border-0 pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="card-label">作業時間</h5>
                                </div>
                            </div>
                            <div class="card-body py-0">
                                <div class="row w-100 disable-print">
                                    <div class="col-md-6">
                                        <label class="form-label">開始時間:</label>
                                        <input type="text" class="form-control flatpickr-time text-start" placeholder="HH:MM" name="start_time" id="start_time"/>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">終了時間:</label>
                                        <input type="text" class="form-control flatpickr-time text-start" placeholder="HH:MM" name="end_time" id="end_time"/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header flex-wrap border-0 pb-0" style="min-height: 30px;">
                                <div class="card-title mb-0">
                                    <h5 class="card-label">作業形態</h5>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row w-100 disable-print">
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="over" id="inlineRadio1" value="1" checked />
                                            <label class="form-check-label" for="inlineRadio1">通常作業</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="over" id="inlineRadio2" value="2" />
                                            <label class="form-check-label" for="inlineRadio2">夜間作業</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header flex-wrap border-0 pb-0" style="min-height: 30px;">
                                <div class="card-title mb-0">
                                    <h5 class="card-label">残業時間</h5>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row w-100 disable-print">
                                    <div class="col-md-9">
                                        <label class="form-label">残業時間:</label>
                                        <input type="number" class="form-control dt-input dt-full-name" data-column="1" name="over_time" id="over_time"
                                               placeholder="残業時間を入力してください。" data-column-index="0" value="0"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-md-12" style="text-align: right">
                            <button class="btn btn-success mr-2" id="btn_shift_change" style="margin-right: 15px;">変　更</button>
                            <label class="btn btn-secondary mr-2" data-bs-dismiss="modal">戻　る</label>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--end::Content-->

    <script>
        let work_report_table = '{{route('master.work-shift-table')}}';
        let work_change_detail = '{{route('master.work-shift-change')}}';
        $(document).ready(function () {
            getTableData('work_report', work_report_table);
            $('.flatpickr-basic').flatpickr();

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('work_report', work_report_table);
            });
            $('#btn_export').click(function () {
                $('#btn_collection').show()
            });
            $('#btn_shift_change').click(function (e) {
                e.preventDefault();
                saveForm('work_detail_change', work_change_detail)
            });
            $('input[type=radio][name=over]').change(function() {
                if (this.value == 3) {
                    $('#rest').show();
                }
                else {
                    $('#rest').hide();
                }
            });

        });
        $(document).on('click', '.work_shift_detail', function () {
            $('#start_time').val($(this).parent().prev().prev().prev().prev().text())
            $('#end_time').val($(this).parent().prev().prev().text())
            var over = $(this).prev().prev().val();
            $("input[name=over][value=" + over + "]").prop('checked', true);
            $("#over_time").val($(this).prev().prev().prev().val());
            $("#shift_id").val($(this).prev().val());
            $('.flatpickr-time').flatpickr({
                enableTime: true,
                noCalendar: true
            });
            $('#worKShiftChangeModal').modal('show');
        });
    </script>
</x-admin-layout>
