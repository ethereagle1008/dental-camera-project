<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">請求書</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">請求書マスター</a>
                            </li>
                            <li class="breadcrumb-item active">請求書
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
                            <h4 class="card-title">請求書</h4>
                        </div>
                        <!--Search Form -->
                        <div class="card-body mt-2">
                            <form class="dt_adv_search" method="POST" id="pay_sum_form">
                                @csrf
                                <div class="row g-1 mb-md-1">
                                    <div class="col-md-3">
                                        <label class="form-label" for="basicSelect">請求会社選択</label>
                                        <select class="form-select" name="year">
                                            @foreach($company as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                                <option value="{{$i}}" {{$i == intval(date('m')) ? 'selected' : ''}}>{{$i}}月</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success mr-2" id="btn_get_invoice" style="margin-top: 23px;">請求総括表</button>
                                        <a class="btn btn-success mr-2"
                                           href="{{ route('master.invoice-export-down') }}?request_month={{ date('Y-n') }}"
                                           id="btn_down_table2" style="margin-top: 23px;">請求総括表(ダウンロード)</a>
                                        <a class="btn btn-success mr-2"
                                           href="{{ route('master.invoice-detail-export-down') }}?request_month={{ date('Y-m') }}"
                                           id="btn_down_table1" style="margin-top: 23px;">請求書（明細）</a>

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
        let invoice_detail_export = '{{ route('master.invoice-detail-export-down') }}';
        let invoice_export_down = '{{ route('master.invoice-export-down') }}';
        let invoice_table = '{{route('master.invoice-table')}}';
        let invoice_change = '{{route('master.invoice-change')}}';
        $(document).ready(function () {
            getTableData('pay_sum', invoice_table);
            $('#btn_get_invoice').click(function (e) {
                e.preventDefault();
                getTableData('pay_sum', invoice_table);
            });
        });
        $('#year').change(function(e) {
            let new_url = invoice_detail_export + '?request_month=' + $(this).val() + '-' + $('#month').val();
            $('#btn_down_table1').attr('href', new_url);
            new_url = invoice_export_down + '?request_month=' + $(this).val() + '-' + $('#month').val();
            $('#btn_down_table2').attr('href', new_url);
        });
        $('#month').change(function(e) {
            let new_url = invoice_detail_export + '?request_month=' + $('#year').val() + '-' + $(this).val();
            $('#btn_down_table1').attr('href', new_url);
            new_url = invoice_export_down + '?request_month=' + $('#year').val() + '-' + $(this).val();
            $('#btn_down_table2').attr('href', new_url);
        });

        $(document).on('click', '.ex_change', function () {
            let id = $(this).data('id');
            let amount = $(this).parent().prev().find('input').val();
            console.log(amount);
            var paramObj = new FormData($('#pay_sum_form')[0]);
            paramObj.append('site_id', id);
            paramObj.append('amount', amount);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: invoice_change,
                type:'post',
                data: paramObj,
                contentType: false,
                processData: false,
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
                        toastr.success("変更しました。");
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
