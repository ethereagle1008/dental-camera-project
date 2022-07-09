<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">出張適用一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">出張適用マスター</a>
                            </li>
                            <li class="breadcrumb-item active">出張適用一覧
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
                                    <h4 class="card-title mb-0">出張適用一覧</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div
                                        class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <button class="dt-button add-new btn btn-primary" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modals-slide-in"><span>出張適用追加</span>
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
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">採用場所</th>
                                    <th colspan="3" class="text-center">現場情報</th>
                                    <th colspan="2" class="text-center">出張適用期間（移動日は含まない）</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">現場名</th>
                                    <th class="text-center">現場所在地</th>
                                    <th class="text-center">始</th>
                                    <th class="text-center">終</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td class="text-center">{{$item->user->id}}</td>
                                        <td class="text-center">{{$item->user->name}}</td>
                                        <td class="text-center">{{$item->user->place->name}}</td>
                                        <td class="text-center">{{$item->site->id}}</td>
                                        <td class="text-center">{{$item->site->name}}</td>
                                        <td class="text-center">{{$item->site->address}}</td>
                                        <td class="text-center">{{isset($item->start_date) ? date('m/d/Y', strtotime($item->start_date)) : ''}}</td>
                                        <td class="text-center">{{isset($item->end_date) ? date('m/d/Y', strtotime($item->end_date)) : ''}}</td>
                                        <td>
                                            <input type="hidden" value="{{$item->start_date}}">
                                            <input type="hidden" value="{{$item->end_date}}">
                                            <a data-id="{{$item->id}}" class="item-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-edit font-small-4">
                                                    <path
                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path
                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <a class="item-delete" data-id="{{$item->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-trash-2 font-small-4 me-50">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0" id="company_add">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×
                </button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">出張適用追加</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">ユーザー</label>
                        <select class="form-select" name="user_id" required>
                            <option></option>
                            @foreach($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">現場</label>
                        <select class="form-select" name="site_id" required>
                            <option></option>
                            @foreach($sites as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">始</label>
                        <input type="text" class="form-control flatpickr-basic" name="start_date" placeholder="YYYY-MM-DD" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">車種</label>
                        <input type="text" class="form-control flatpickr-basic" name="end_date" placeholder="YYYY-MM-DD"/>
                    </div>
                    <button type="submit" class="btn btn-primary me-1 data-submit" id="saveBtn">追加</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        キャンセル
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal to add new user Ends-->

    <div class="modal fade text-start" id="modifyForm" tabindex="-1" aria-labelledby="myModalLabel33"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">出張適用変更</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modify_form">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <label>自社OR傭車: </label>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-uname">ユーザー</label>
                            <select class="form-select" name="user_id" id="user_id" required>
                                <option></option>
                                @foreach($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-uname">現場</label>
                            <select class="form-select" name="site_id" id="site_id" required>
                                <option></option>
                                @foreach($sites as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">始</label>
                            <input type="text" class="form-control flatpickr-basic" name="start_date" id="start_date" placeholder="YYYY-MM-DD" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">車種</label>
                            <input type="text" class="form-control flatpickr-basic" name="end_date" id="end_date" placeholder="YYYY-MM-DD"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary modifyBtn">変更</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        let qualify_add = '{{route('master.travel-save')}}';
        let qualify_delete = '{{route('master.travel-delete')}}';
        $(document).ready(function (){
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
