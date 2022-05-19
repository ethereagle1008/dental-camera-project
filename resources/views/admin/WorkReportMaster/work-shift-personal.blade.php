<div class="card-header pb-0">
    <div class="row text-center">
        <div class="col-md-12 text-center">
            <h2>個人別勤務表({{contractType($tmp['contract_type'])}}用)</h2>
        </div>
    </div>
</div>
<div class="card-body py-0">
    <div class="row w-100 disable-print">
        <div class="col-md-12">
            <div class="card-label">
                <p>
                    <span>ID: </span><span id="user_id">{{$tmp['id']}}</span>
                </p>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card-label">
                <p>
                    <span>氏名: </span><span id="user_name">{{$tmp['name']}}</span>
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-label">
                <p>
                    <span>作業月報: </span><span id="month">{{$tmp['month']}}</span><span>月分</span>
                </p>
            </div>
        </div>

    </div>
</div>
<div class="card-body pt-0">
    <div class="row w-100 disable-print">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>日</th>
                    <th>現場ID</th>
                    <th>現場名</th>
                    <th>夜間マーク</th>
                    <th>開始時間</th>
                    <th>終了時間</th>
                    <th>認定残業時間</th>
                    <th>昼間出勤日数</th>
                    <th>夜間出勤日数</th>
                </tr>
                </thead>
                <tbody>
                @for($i = 1; $i < 32; $i++)
                    @foreach($tmp['shifts'] as $shift)
                        @if(date('Y-m-d', strtotime(str_replace('.', '-', $tmp['month']).'-' .$i)) == date('Y-m-d', strtotime($shift->shift_date)))
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$shift->site->id}}</td>
                                <td>{{$shift->site->name}}</td>
                                <td>{{$shift->over == 1 ? 'NO' : 'YES'}}</td>
                                <td>{{date('H:i', strtotime($shift->start_time))}}</td>
                                <td>{{date('H:i', strtotime($shift->end_time))}}</td>
                                <td>{{$shift->over_time}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                    @endforeach
                @endfor
                <tr>
                    <td>調整勤務</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>合計</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$tmp['over_time']}}</td>
                    <td>{{$tmp['shift_normal']}}</td>
                    <td>{{$tmp['shift_night']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card-header flex-wrap border-0 pb-0" style="min-height: 30px;">
    <div class="card-title mb-0">
        <h5 class="card-label">収入</h5>
    </div>
</div>
<div class="card-body pt-0">
    <div class="row w-100">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>項目</th>
                    <th>数量</th>
                    <th>単位</th>
                    <th>単価</th>
                    <th>金額</th>
                    <th>摘要</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>通常作業</td>
                    <td>{{$tmp['shift_normal']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByRole(1, $tmp['contract_type'], 1)}}</td>
                    <td>{{$tmp['price_normal']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>夜間作業</td>
                    <td>{{$tmp['shift_night']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByRole(1, $tmp['contract_type'], 2)}}</td>
                    <td>{{$tmp['price_night']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>残業</td>
                    <td>{{$tmp['over_time']}}</td>
                    <td>時間</td>
                    <td>{{calculatePriceByRole(1, $tmp['contract_type'], 3)}}</td>
                    <td>{{$tmp['price_over']}}</td>
                    <td></td>
                </tr>
                @if($tmp['contract_type'] == 4)
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>所長手当（直分）</td>
                        <td>{{$tmp['sub_staff']}}</td>
                        <td>人月</td>
                        <td>7000</td>
                        <td>{{$tmp['sub_price']}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>所長手当（子分）</td>
                        <td>{{$tmp['direct_staff']}}</td>
                        <td>人月</td>
                        <td>3000</td>
                        <td>{{$tmp['direct_price']}}</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
                <tr>
                    <td>合計</td>
                    <td>1</td>
                    <td>式</td>
                    <td></td>
                    <td>{{$tmp['a_price']}}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card-header flex-wrap border-0 pb-0" style="min-height: 30px;">
    <div class="card-title mb-0">
        <h5 class="card-label">控除</h5>
    </div>
</div>
<div class="card-body pt-0">
    <div class="row w-100 disable-print">
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th>項目</th>
                    <th>数量</th>
                    <th>単位</th>
                    <th>単価</th>
                    <th>金額</th>
                    <th>摘要</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>労災組合費</td>
                    <td>1</td>
                    <td>月</td>
                    <td>{{calculatePriceByType(1, 'insurance')}}</td>
                    <td>{{$tmp['insurance']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>労災保険料</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByType(1, 'self-insurance')}}</td>
                    <td>{{$tmp['self_insurance']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>安全協力会費</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByRole(1, $tmp['contract_type'], 'safe-cost')}}</td>
                    <td>{{$tmp['safe_cost']}}</td>
                    <td>日額＊3㌫</td>
                </tr>
                <tr>
                    <td>作業服</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByType(1, 'cloth')}}</td>
                    <td>{{$tmp['cloth']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>ヘルメット</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByType(1, 'helmet')}}</td>
                    <td>{{$tmp['helmet']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>寮費</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByType(1, 'dormitory')}}</td>
                    <td>{{$tmp['dormitory']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>携帯電話</td>
                    <td>{{$tmp['shift_total']}}</td>
                    <td>日</td>
                    <td>{{calculatePriceByType(1, 'phone')}}</td>
                    <td>{{$tmp['business_phone']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>前払い</td>
                    <td>1</td>
                    <td>式</td>
                    <td></td>
                    <td>{{$tmp['pre_pay']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>控除合計</td>
                    <td>1</td>
                    <td>式</td>
                    <td></td>
                    <td>{{$tmp['b_price']}}</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card-body py-0">
    <div class="row w-100 disable-print">
        <div class="col-md-4">
            <div class="card-label text-center">
                <p>
                    <span>当月支払額合計:</span>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-label text-center">
                <p>
                    <span>収入－控除</span>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-label text-center">
                <p>
                    <span id="total_price">{{number_format($tmp['a_price'] - $tmp['b_price'])}}</span>
                </p>
            </div>
        </div>

    </div>
    <div class="row w-100 disable-print">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="card-label text-center">
                <p>
                    <span id="total_price">＊金額はすべて消費財込みの表示です。</span>
                </p>
            </div>
        </div>

    </div>
</div>
