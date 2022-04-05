<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">請求会社一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">請求会社マスター</a>
                            </li>
                            <li class="breadcrumb-item active">請求会社一覧
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
                            <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">請求会社一覧</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <button class="dt-button add-new btn btn-primary" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modals-slide-in"><span>請求会社追加</span>
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
                                    <th rowspan="2" style="vertical-align: middle">会社番号</th>
                                    <th rowspan="2" style="vertical-align: middle">会社名</th>
                                    <th colspan="5" class="text-center">請求書郵送先</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr>
                                    <th>郵便番号</th>
                                    <th>住所</th>
                                    <th>電話番号</th>
                                    <th>FAX番号</th>
                                    <th>E-mail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->post_code}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->fax}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            <a data-id="{{$item->id}}" class="item-edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </a>
                                            <a class="item-delete" data-id="{{$item->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 me-50">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line>
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
                    <h5 class="modal-title" id="exampleModalLabel">会社追加</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">会社名</label>
                        <input type="text" class="form-control dt-full-name" placeholder="会社名" name="name" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">郵便番号</label>
                        <input type="text" class="form-control dt-full-name" placeholder="郵便番号" name="post_code" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">住所</label>
                        <input type="text" class="form-control dt-full-name" placeholder="住所" name="address" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">電話番号</label>
                        <input type="text" class="form-control dt-full-name" placeholder="電話番号" name="phone" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">FAX番号</label>
                        <input type="text" class="form-control dt-uname" placeholder="FAX番号" name="fax" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">E-mail</label>
                        <input type="email" class="form-control dt-uname" placeholder="E-mail" name="email" required/>
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
                    <h4 class="modal-title" id="myModalLabel33">請求会社変更</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="modify_form">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="modal-body">
                        <label>会社名: </label>
                        <div class="mb-1">
                            <input type="text" class="form-control" placeholder="会社名" name="name" id="name" required/>
                        </div>

                        <label>郵便番号: </label>
                        <div class="mb-1">
                            <input type="text" class="form-control" placeholder="郵便番号" name="post_code" id="post_code" required/>
                        </div>
                        <label>住所: </label>
                        <div class="mb-1">
                            <input type="text" class="form-control" placeholder="住所" name="address" id="address" required/>
                        </div>

                        <label>電話番号: </label>
                        <div class="mb-1">
                            <input type="text" class="form-control" placeholder="電話番号" name="phone" id="phone" required/>
                        </div>
                        <label>FAX番号: </label>
                        <div class="mb-1">
                            <input type="text" class="form-control" placeholder="FAX番号" name="fax" id="fax" required/>
                        </div>

                        <label>E-mail: </label>
                        <div class="mb-1">
                            <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" required/>
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
        let qualify_add = '{{route('master.company-save')}}';
        let qualify_delete = '{{route('master.company-delete')}}';
        // toastr.options = {
        //     "closeButton": true,
        //     "debug": false,
        //     "newestOnTop": false,
        //     "progressBar": false,
        //     "positionClass": "toast-top-right",
        //     "preventDuplicates": false,
        //     "onclick": null,
        //     "showDuration": "300",
        //     "hideDuration": "1000",
        //     "timeOut": "5000",
        //     "extendedTimeOut": "1000",
        //     "showEasing": "swing",
        //     "hideEasing": "linear",
        //     "showMethod": "fadeIn",
        //     "hideMethod": "fadeOut"
        // };
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            if($('#company_add').valid()){
                var paramObj = new FormData($('#company_add')[0]);
                $.ajax({
                    url: qualify_add,
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == true){
                            toastr.success("成功しました。");
                            $('#modals-slide-in').modal('hide');
                            window.location.reload();
                        }
                        else {
                            toastr.warning("失敗しました。");
                        }

                    },
                });
            }
        })
        $('.item-edit').click(function (e) {
            $('#id').val($(this).data('id'));
            $('#name').val($(this).parent().prev().prev().prev().prev().prev().prev().text());
            $('#post_code').val($(this).parent().prev().prev().prev().prev().prev().text());
            $('#address').val($(this).parent().prev().prev().prev().prev().text());
            $('#phone').val($(this).parent().prev().prev().prev().text());
            $('#fax').val($(this).parent().prev().prev().text());
            $('#email').val($(this).parent().prev().text());
            $('#modifyForm').modal('show');
        })
        $('.modifyBtn').click(function (e) {
            if($('#modify_form').valid()){
                var paramObj = new FormData($('#modify_form')[0]);
                $.ajax({
                    url: qualify_add,
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == true){
                            toastr.success("成功しました。");
                            $('#modals-slide-in').modal('hide');
                            $('#modifyForm').modal('hide');
                            window.location.reload();
                        }
                        else {
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
                type:'post',
                data: {
                    id : id
                },
                success: function (response) {

                    if(response.status == true){
                        toastr.success("成功しました。");
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
