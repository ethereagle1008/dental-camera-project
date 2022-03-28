<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">管理者一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">人事マスター</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">管理者管理</a>
                            </li>
                            <li class="breadcrumb-item active">管理者一覧
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
                        <div class="card-header border-bottom">
                            <h4 class="card-title">管理者一覧</h4>
                        </div>
                        <div class="card-body" id="table-part">
                            <table class="datatables-ajax table table-responsive" id="admin-table">
                                <thead>
                                <tr>
                                    <th>名前</th>
                                    <th>電話番号</th>
                                    <th>メールアドレス</th>
                                    <th>権限</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->phone}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->role == 'super' ? 'スーパー管理者' : '事務職管理者'}}</td>
                                        <td>
                                            <a href="{{route('master.person-admin-edit', $item->id)}}" class="item-edit">
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
    <script>
        let admin_delete = '{{route('master.person-admin-delete')}}';
        $(document).ready(function () {
            $('#admin-table').DataTable({
                responsive: !0,
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                language: {
                    "decimal":        "",
                    "emptyTable":     "現在ありません",
                    "info":           "_TOTAL_個の資料の中で_START_~_END_が現示されます。",
                    "infoEmpty":      "0~0の0を表示。",
                    "infoFiltered":   "(filtered from _MAX_ total entries)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     " _MENU_ ",
                    "loadingRecords": "ロード中...",
                    "processing":     "処理中...",
                    "search":         "検索:",
                    "zeroRecords":    "一致する検索資料がありません。",
                    "paginate": {
                        "first":      "初めに",
                        "last":       "最後",
                        "next":       "次へ",
                        "previous":   "前へ"
                    },
                },
            });
            $('.item-delete').click(function (e) {
                let id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: admin_delete,
                    type:'post',
                    data: {
                        user_id : id
                    },
                    // beforeSend: function(){
                    //     $("#global-loader").fadeIn("slow")
                    // },
                    // complete: function(){
                    //     $("#global-loader").fadeOut("slow")
                    // },
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
        })
    </script>
</x-admin-layout>
