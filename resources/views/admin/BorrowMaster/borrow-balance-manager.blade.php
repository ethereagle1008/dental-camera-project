<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">出力借入残高一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">出力借入残高マスター</a>
                            </li>
                            <li class="breadcrumb-item active">出力借入残高一覧
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="admin-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div
                                class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">出力借入残高一覧</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div
                                        class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <button class="dt-button add-new btn btn-primary" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modals-slide-in"><span>出力借入残高追加</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="table-part">
                            <table class="datatables-ajax table table-responsive" id="admin-table">
                                <thead>
                                <tr>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">個人番号</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">氏名</th>
                                    <th colspan="3" class="text-center">合計額</th>
                                    <th colspan="4" class="text-center">個別借入明細</th>
                                </tr>
                                <tr>
                                    <th class="text-center">当初借入</th>
                                    <th class="text-center">返済額</th>
                                    <th class="text-center">残高</th>
                                    <th class="text-center">借入番号</th>
                                    <th class="text-center">当初借入金額</th>
                                    <th class="text-center">返済額</th>
                                    <th class="text-center">残高</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user_data as $item)
                                    <tr>
                                        <td rowspan="{{count($item->pay_data)}}" class="text-center"
                                            style="vertical-align: middle">{{$item->user_id}}</td>
                                        <td rowspan="{{count($item->pay_data)}}" class="text-center"
                                            style="vertical-align: middle">{{$item->name}}</td>
                                        <td rowspan="{{count($item->pay_data)}}" class="text-center"
                                            style="vertical-align: middle">{{$item->qt}}</td>
                                        <td rowspan="{{count($item->pay_data)}}" class="text-center"
                                            style="vertical-align: middle">{{$item->paid}}</td>
                                        <td rowspan="{{count($item->pay_data)}}" class="text-center"
                                            style="vertical-align: middle">{{$item->remain}}</td>
                                        @for($i = 0,$iMax = count($item->pay_data); $i < $iMax; $i++)
                                            @if($i == 0)
                                                <td class="text-center">{{$item->pay_data[$i]['id']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['amount']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['paid']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['remain']}}</td>
                                            @endif
                                        @endfor
                                    </tr>
                                    @for($i = 1,$iMax = count($item->pay_data); $i < $iMax; $i++)
                                        <tr>
                                            @if($i > 0)
                                                <td class="text-center">{{$item->pay_data[$i]['id']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['amount']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['paid']}}</td>
                                                <td class="text-center">{{$item->pay_data[$i]['remain']}}</td>
                                            @endif
                                        </tr>
                                    @endfor
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        let qualify_add = '{{route('master.travel-save')}}';
        let qualify_delete = '{{route('master.travel-delete')}}';
        $(document).ready(function () {
            $('.flatpickr-basic').flatpickr();
        })

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            if ($('#company_add').valid()) {
                var paramObj = new FormData($('#company_add')[0]);
                $.ajax({
                    url: qualify_add,
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success("成功しました。");
                            $('#modals-slide-in').modal('hide');
                            window.location.reload();
                        } else {
                            toastr.warning("失敗しました。");
                        }

                    },
                });
            }
        })
        $('.item-edit').click(function (e) {
            $('#id').val($(this).data('id'));
            let name = $(this).parent().prev().prev().prev().prev().prev().prev().prev().text();

            $("select#user_id option").filter(function () {
                //may want to use $.trim in here
                return $(this).text() == name;
            }).prop('selected', true);

            name = $(this).parent().prev().prev().prev().prev().text();
            $("select#site_id option").filter(function () {
                //may want to use $.trim in here
                return $(this).text() == name;
            }).prop('selected', true);

            $('#start_date').val($(this).prev().prev().val());
            $('#end_date').val($(this).prev().val());
            $('#modifyForm').modal('show');
        })
        $('.modifyBtn').click(function (e) {
            if ($('#modify_form').valid()) {
                var paramObj = new FormData($('#modify_form')[0]);
                $.ajax({
                    url: qualify_add,
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success("成功しました。");
                            $('#modals-slide-in').modal('hide');
                            $('#modifyForm').modal('hide');
                            window.location.reload();
                        } else {
                            toastr.warning("失敗しました。");
                        }

                    },
                });
            }
        })
        $('.item-delete').click(function (e) {
            let id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            $.ajax({
                url: qualify_delete,
                type: 'post',
                data: {
                    id: id
                },
                success: function (response) {

                    if (response.status == true) {
                        toastr.success("成功しました。");
                        window.location.reload()
                    } else {
                        toastr.warning("失敗しました。");
                    }
                },
                error: function () {

                }
            });
        })
    </script>
</x-admin-layout>
