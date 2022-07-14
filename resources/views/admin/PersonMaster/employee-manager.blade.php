<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">社員一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">人事マスター</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">ユーザー管理</a>
                            </li>
                            <li class="breadcrumb-item active">社員一覧
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
                            <h4 class="card-title">社員一覧</h4>
                        </div>
                        <div class="card-content py-2" style="overflow:auto;">
                            <div class="card-datatable px-2" id="work_shift_total" style="width: 250% !important;">
                                <table class="datatables-ajax table table-responsive" id="admin-table">
                                    <thead>
                                    <tr>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle">個人番号</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle">氏名</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle">採用場所</th>
                                        <th colspan="2" class="text-center">入退社日時</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle">日給月給　OR　月給</th>
                                        <th rowspan="3" class="text-center" style="vertical-align: middle">給料支払いサイト　週OR月</th>
                                        <th colspan="14" class="text-center">給料項目</th>
                                        <th colspan="4" class="text-center">請求項目</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">入社日</th>
                                        <th rowspan="2" class="text-center" style="vertical-align: middle">退社日</th>
                                        <th colspan="13" class="text-center">手当</th>
                                        <th colspan="1" class="text-center">控除項目（日額）</th>
                                        <th colspan="4" class="text-center">占部組　請求基本額</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">完全月給</th>
                                        <th class="text-center">基本日給</th>
                                        <th class="text-center">保証日数</th>
                                        <th class="text-center">基本月給</th>
                                        <th class="text-center">班長</th>
                                        <th class="text-center">車両免許</th>
                                        <th class="text-center">重機免許</th>
                                        <th class="text-center">出張手当</th>
                                        <th class="text-center">その他</th>
                                        <th class="text-center">請求時査定昼間基本日額</th>
                                        <th class="text-center">請求時夜間基本日額</th>
                                        <th class="text-center">請求時昼間残業代</th>
                                        <th class="text-center">請求時夜間残業代</th>
                                        <th class="text-center">寮費</th>
                                        <th class="text-center">昼間日額</th>
                                        <th class="text-center">昼間残業代</th>
                                        <th class="text-center">夜間日額</th>
                                        <th class="text-center">夜間残業代</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $item)
                                        <tr>
                                            <td class="text-center">{{$item->id}}</td>
                                            <td class="text-center">{{$item->name}}</td>
                                            <td class="text-center">{{$item->place->name}}</td>
                                            <td class="text-center">{{isset($item->enter_date) ? date('m/d/Y', strtotime($item->enter_date)) : ''}}</td>
                                            <td class="text-center">{{isset($item->exit_date) ? date('m/d/Y', strtotime($item->exit_date)) : ''}}</td>
                                            <td class="text-center">{{$item->salary_type == 1 ? "日給月給" : "月給"}}</td>
                                            <td class="text-center">{{$item->payment_type == 1 ? "週" : "月"}}</td>
                                            <td class="text-center">{{$item->full_salary}}</td>
                                            <td class="text-center">{{$item->contract_value}}</td>
                                            <td class="text-center">{{$item->guarantee_day}}</td>
                                            <td class="text-center">{{$item->contract_value * $item->guarantee_day}}</td>
                                            <td class="text-center">{{$item->contract_type == 3 ? "YES" : "NO"}}</td>
                                            <td class="text-center">{{$item->vehicle_license == 1 ? "YES" : "NO"}}</td>
                                            <td class="text-center">{{$item->heavy_license == 1 ? "YES" : "NO"}}</td>
                                            <td class="text-center">{{$item->move_value}}</td>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{$item->contract_value}}</td>
                                            <td class="text-center">{{$item->contract_value * 1.5}}</td>
                                            <td class="text-center">{{$item->contract_value / 8 * 1.25}}</td>
                                            <td class="text-center">{{$item->contract_value * 1.5 / 8 * 1.25}}</td>
                                            <td class="text-center">{{$item->dormitory}}</td>
                                            <td class="text-center">{{$item->daily_amount}}</td>
                                            <td class="text-center">{{$item->overtime_amount}}</td>
                                            <td class="text-center">{{$item->night_amount}}</td>
                                            <td class="text-center">{{$item->overnight_amount}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
</x-admin-layout>
