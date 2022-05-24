<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">月別前払い一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">前払いマスター</a>
                            </li>
                            <li class="breadcrumb-item active">月別前払い一覧
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
                            <h4 class="card-title">月別前払い一覧表</h4>
                        </div>
                        <hr class="my-0"/>
                        <div class="card-content" style="overflow:auto;">
                            <div class="card-datatable px-2" id="pay_sum_personal">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>日時</th>
                                        <th>金額</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($history as $index => $item)
                                        <tr>
                                            <td>{{date('Y.m.d', strtotime($index))}}</td>
                                            <td>
                                                <?php
                                                $t = 0;
                                                foreach ($item as $itm){
                                                    $t = $t + $itm->payment;
                                                }
                                                echo $t;
                                                ?>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>合計</td>
                                        <td>{{$total}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ Advanced Search -->
    </div>

    <script>
        $(document).ready(function () {
            var t = $('#table');
            t.DataTable({
                responsive: !0,
                dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
                lengthMenu: [5, 10, 25, 50],
                pageLength: 10,
                ordering: false,
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
        });
    </script>
</x-admin-layout>
