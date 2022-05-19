<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">人事総括</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">人事マスター</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">ユーザー管理</a>
                            </li>
                            <li class="breadcrumb-item active">人事総括
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
                            <h4 class="card-title">人事総括</h4>
                        </div>
                        <div class="card-body mt-2 d-none">
                            <form class="dt_adv_search" method="POST" id="work_report_form">
                                @csrf
                                <div class="row g-1 mb-md-1">
                                    <div class="col-md-6">
                                        <label class="form-label">月選択:</label>
                                        <input type="text" id="birthday" class="form-control" name="report_date" placeholder="YYYY-MM"
                                               data-column="2" value="{{date('Y-m')}}"  data-column-index="1"/>
                                    </div>
                                </div>
                                <div class="row g-1">
                                    <button class="btn btn-success mr-2" id="btn_get_table">検　索</button>
                                </div>
                            </form>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body" id="table-part">
                            <table class="datatables-ajax table table-responsive" id="admin-table">
                                <thead>
                                <tr>
                                    <th class="px-1">ID</th>
                                    <th class="px-1">氏名</th>
                                    <th class="px-1">契約形態</th>
                                    <th class="px-1">職階</th>
                                    <th class="px-1">昼間日給</th>
                                    <th class="px-1">1人親方組合</th>
                                    <th class="px-1">労災</th>
                                    <th class="px-1">安全協力会費</th>
                                    <th class="px-1">作業服</th>
                                    <th class="px-1">ヘルメット</th>
                                    <th class="px-1">寮費</th>
                                    <th class="px-1">携帯</th>
                                    <th class="px-1">摘要</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td class="px-1">{{$item->id}}</td>
                                        <td class="px-1">{{$item->name}}</td>
                                        <td class="px-1">{{contractType($item->contract_type)}}</td>
                                        <td class="px-1"></td>
                                        <td class="px-1"></td>
                                        <td class="px-1">{{$item->insurance == 1 ? 'YES' : 'NO'}}</td>
                                        <td class="px-1">YES</td>
                                        <td class="px-1">YES</td>
                                        <td class="px-1">{{$item->cloth == 1 ? 'YES' : 'NO'}}</td>
                                        <td class="px-1">YES</td>
                                        <td class="px-1">{{$item->dormitory == 1 ? 'YES' : 'NO'}}</td>
                                        <td class="px-1">{{$item->business_phone == 1 ? 'YES' : 'NO'}}</td>
                                        <td class="px-1"></td>
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
