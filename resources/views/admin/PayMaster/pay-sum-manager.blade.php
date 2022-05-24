<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">前払い総括表</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">前払いマスター</a>
                            </li>
                            <li class="breadcrumb-item active">前払い総括
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
                            <h4 class="card-title">前　払　い　総　括　表</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" id="pay_sum_form">
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
                            <form id="pay_person_form" class="d-none">
                                @csrf
                                <input type="hidden" name="user_id" id="user_id">
                                <input type="hidden" name="year" id="year_form">
                                <input type="hidden" name="month" id="month_form">
                            </form>
                        </div>
                        <hr class="my-0"/>
                        <div class="card-content" style="overflow:auto;">
                            <div class="card-datatable px-2" id="pay_sum">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Advanced Search -->
    </div>

    <!-- Modal-->
    <div class="modal fade text-start" id="payPersonModal" tabindex="-1"
         aria-labelledby="payPersonModal" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">個人別前払表</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-custom w-100 position-relative" id="pay_person">

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
        let pay_sum_table = '{{route('master.pay-sum-table')}}';
        let pay_person = '{{route('master.pay-person-table')}}';
        $(document).ready(function () {
            getTableData('pay_sum', pay_sum_table);
            $('.flatpickr-basic').flatpickr();

            $('#btn_get_table').click(function (e) {
                e.preventDefault();
                getTableData('pay_sum', pay_sum_table);
            });
            // $('#btn_export').click(function () {
            //     $('#btn_collection').show()
            // })
        });
        $(document).on('click', '.person_pay', function () {
            $('#user_id').val($(this).prev().val());
            $("#year_form").val($('#year').val());
            $('#month_form').val($('#month').val());
            getTableData('pay_person', pay_person, false);
            $('#payPersonModal').modal('show');
        });
    </script>
</x-admin-layout>
