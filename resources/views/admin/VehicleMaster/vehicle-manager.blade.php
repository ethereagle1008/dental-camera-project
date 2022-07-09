<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">車両一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">車両マスター</a>
                            </li>
                            <li class="breadcrumb-item active">車両一覧
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
                                    <h4 class="card-title mb-0">車両一覧</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div
                                        class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <button class="dt-button add-new btn btn-primary" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modals-slide-in"><span>車両追加</span>
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
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">管理番号</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">自社OR傭車</th>
                                    <th colspan="2" class="text-center">所有者</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">車番</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">車種</th>
                                    <th rowspan="2" class="text-center" style="vertical-align: middle">管理者</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">氏名</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->owner_type == 1 ? "自社" : "庸車"}}</td>
                                        <td>{{$item->owner_type == 2 ? $item->user->id : ""}}</td>
                                        <td>{{$item->owner_type == 2 ? $item->user->name : "会社"}}</td>
                                        <td>{{$item->number}}</td>
                                        <td>{{$item->type}}</td>
                                        <td>{{$item->manager}}</td>
                                        <td>
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
                    <h5 class="modal-title" id="exampleModalLabel">車両追加</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <select class="form-select owner_type" name="owner_type">
                            <option value="1">自社</option>
                            <option value="2">傭車</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">所有者</label>
                        <select class="form-select user_id" name="user_id" disabled required>
                            <option></option>
                            @foreach($users as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">車番</label>
                        <input type="text" class="form-control dt-full-name" placeholder="車番" name="number" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">車種</label>
                        <input type="text" class="form-control dt-full-name" placeholder="車種" name="type" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">管理者</label>
                        <input type="text" class="form-control dt-full-name" placeholder="管理者" name="manager"/>
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
                    <h4 class="modal-title" id="myModalLabel33">車両変更</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modify_form">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <label>自社OR傭車: </label>
                        <div class="mb-1">
                            <select class="form-select owner_type" name="owner_type" id="owner_type">
                                <option value="1">自社</option>
                                <option value="2">傭車</option>
                            </select>
                        </div>
                        <div class="mb-1">
                            <label>所有者: </label>
                            <select class="form-select user_id" name="user_id" id="user_id" disabled required>
                                <option></option>
                                @foreach($users as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">車番</label>
                            <input type="text" class="form-control dt-full-name" placeholder="車番" name="number"
                                   id="number" required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">車種</label>
                            <input type="text" class="form-control dt-full-name" placeholder="車種" name="type" id="type"
                                   required/>
                        </div>
                        <div class="mb-1">
                            <label class="form-label" for="basic-icon-default-fullname">管理者</label>
                            <input type="text" class="form-control dt-full-name" placeholder="管理者" name="manager"
                                   id="manager"/>
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
        let qualify_add = '{{route('master.vehicle-save')}}';
        let qualify_delete = '{{route('master.vehicle-delete')}}';

        $('.owner_type').change(function () {
            console.log($(this).parent().next().find('.user_id'))
            if ($(this).val() == 1) {
                $(this).parent().next().find('.user_id')[0].disabled = true;
            } else {
                $(this).parent().next().find('.user_id')[0].disabled = false;
            }

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


            let name = $(this).parent().prev().prev().prev().prev().prev().prev().text();

            if (name == "庸車") {
                console.log(name)
                $('#owner_type').val(2).change()
                let app_name = $(this).parent().prev().prev().prev().prev().text();
                $("select#user_id option").filter(function () {
                    //may want to use $.trim in here
                    return $(this).text() == app_name;
                }).prop('selected', true);
            } else {
                $('#owner_type').val(1).change()
            }
            $("select#owner_type option").filter(function () {
                //may want to use $.trim in here
                return $(this).text() == name;
            }).prop('selected', true);
            $('#number').val($(this).parent().prev().prev().prev().text());
            $('#type').val($(this).parent().prev().prev().text());
            $('#manager').val($(this).parent().prev().text());
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
