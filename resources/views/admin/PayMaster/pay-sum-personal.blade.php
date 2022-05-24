<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">個人別前払い一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">前払いマスター</a>
                            </li>
                            <li class="breadcrumb-item active">個人別前払い一覧
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
                            <h4 class="card-title">個人別前払い一覧表</h4>
                        </div>
                        <!--Search Form -->
{{--                        <div class="card-body mt-2">--}}
{{--                            <form class="dt_adv_search" method="POST" id="pay_sum_form">--}}
{{--                                @csrf--}}
{{--                                <div class="row g-1 mb-md-1">--}}
{{--                                    <div class="col-md-2">--}}
{{--                                        <label class="form-label" for="basicSelect">年選択</label>--}}
{{--                                        <select class="form-select" id="year" name="year">--}}
{{--                                            @for($i = 2022; $i < 2200; $i++)--}}
{{--                                                <option value="{{$i}}">{{$i}}</option>--}}
{{--                                            @endfor--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-1">--}}
{{--                                        <label class="form-label" for="basicSelect">月選択</label>--}}
{{--                                        <select class="form-select" id="month" name="month">--}}
{{--                                            @for($i = 1; $i < 13; $i++)--}}
{{--                                                <option--}}
{{--                                                    value="{{$i}}" {{$i == intval(date('m')) ? 'selected' : ''}}>{{$i}}月--}}
{{--                                                </option>--}}
{{--                                            @endfor--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <button class="btn btn-success mr-2" id="btn_get_table"--}}
{{--                                                style="margin-top: 23px;">検　索--}}
{{--                                        </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                            <form id="pay_person_form" class="d-none">--}}
{{--                                @csrf--}}
{{--                                <input type="hidden" name="user_id" id="user_id">--}}
{{--                                <input type="hidden" name="year" id="year_form">--}}
{{--                                <input type="hidden" name="month" id="month_form">--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <hr class="my-0"/>
                        <div class="card-content" style="overflow:auto;">
                            <div class="card-datatable px-2" id="pay_sum_personal">
                                <table class="table" id="table">
                                    <thead>
                                    <tr>
                                        <th>個人ID</th>
                                        <th>氏名</th>
                                        <th>日時</th>
                                        <th>金額</th>
                                        <th>合計金額</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($history as $item)
                                        @foreach($item as $i => $it)
                                            <tr>
                                                <td>{{$i == 0 ? $it->user_id : ''}}</td>
                                                <td>{{$i == 0 ? $it->user->name : ''}}</td>
                                                <td>{{date('Y.m.d', strtotime($it->updated_at))}}</td>
                                                <td>{{number_format($it->payment)}}</td>
                                                @if($i == count($item) - 1)
                                                    <td>
                                                    <?php
                                                    $t = 0;
                                                    foreach ($item as $itm){
                                                        $t = $t + $itm->payment;
                                                    }
                                                    echo $t;
                                                    ?>
                                                    </td>
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    <tr>
                                        <td>合計</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
