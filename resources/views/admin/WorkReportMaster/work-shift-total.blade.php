<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">労務総括表</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">作業マスター</a>
                            </li>
                            <li class="breadcrumb-item active">労務総括表
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
                            <h4 class="card-title">労　務　者　総　括　表</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" id="work_shift_total_form">
                                @csrf
                                <div class="row g-1 mb-md-1">
                                    <div class="col-md-2">
                                        <label class="form-label" for="basicSelect">年選択</label>
                                        <select class="form-select" id="year" name="year">
                                            @for($i = 2022; $i < 2200; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label" for="basicSelect">月選択</label>
                                        <select class="form-select" id="month" name="month">
                                            @for($i = 1; $i < 13; $i++)
                                                <option
                                                    value="{{$i}}" {{$i == intval(date('m')) ? 'selected' : ''}}>{{$i}}月
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-success mr-2" id="btn_get_table"
                                                style="margin-top: 23px;">検　索
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <form id="work_shift_personal_form" class="d-none">
                                @csrf
                                <input type="hidden" name="user_id" id="user_id">
                                <input type="hidden" name="year" id="year_form">
                                <input type="hidden" name="month" id="month_form">
                            </form>
                        </div>
                        <hr class="my-0"/>
                        <div class="card-content" style="overflow:auto;">
                            <div class="card-datatable px-2" id="work_shift_total" style="width: 180% !important;">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Advanced Search -->
    </div>

    <!-- Modal-->
    <div class="modal fade text-start" id="worKPersonalShiftModal" tabindex="-1"
         aria-labelledby="worKPersonalShiftModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: 1100px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">個人別勤務表</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-custom w-100 position-relative" id="work_shift_personal">

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12" style="text-align: right">
                        <button class="btn btn-success mr-2" id="btn_shift_change" style="margin-right: 15px;" data-bs-dismiss="modal">確　認
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end::Content-->

    <script>
        let work_report_table = '{{route('master.work-shift-total-table')}}';
        let work_shift_personal = '{{route('master.work-shift-personal')}}';
        $(document).ready(function () {
            getTableData('work_shift_total', work_report_table);
            $('.flatpickr-basic').flatpickr();

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('work_shift_total', work_report_table);
            });
            // $('#btn_export').click(function () {
            //     $('#btn_collection').show()
            // })
        });
        $(document).on('click', '.personal_shift', function () {
            $('#user_id').val($(this).prev().val());
            $("#year_form").val($('#year').val());
            $('#month_form').val($('#month').val());
            getTableData('work_shift_personal', work_shift_personal, false);
            $('#worKPersonalShiftModal').modal('show');
        });
    </script>
</x-admin-layout>
