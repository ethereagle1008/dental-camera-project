<table class="table table-separate table-head-custom table-checkable" id="work_shift_total_table">
    <thead>
    <tr>
        <th colspan="3" class="text-center">委託者情報</th>
        <th colspan="4" class="text-center">月間支払額</th>
        <th colspan="10" class="text-center">月次控除額</th>
        <th rowspan="2" class="text-center" style="vertical-align: middle">支払額合計（A）-（B）</th>
        <th rowspan="2" class="text-center" style="vertical-align: middle"></th>
    </tr>
    <tr>
        <th>ID</th>
        <th>氏名</th>
        <th>携帯番号</th>
        <th>通常作業</th>
        <th>夜間作業</th>
        <th>認定残業</th>
        <th>合計(A)</th>
        <th>労災組合費</th>
        <th>労災保険料</th>
        <th>安全協力会費</th>
        <th>作業服</th>
        <th>ヘルメット</th>
        <th>寮費</th>
        <th>携帯</th>
        <th>前払い</th>
        <th>pring手数料</th>
        <th>合計(B)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item['id']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['name']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['phone']}}</td>

            <td class="p-0 border text-center align-middle">{{number_format($item['price_normal'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['price_night'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['price_over'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['a_price'])}}</td>

            <td class="p-0 border text-center align-middle">{{number_format($item['insurance'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['self_insurance'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['safe_cost'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['cloth'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['helmet'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['dormitory'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['business_phone'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['pre_pay'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['pring'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['b_price'])}}</td>

            <td class="p-0 border text-center align-middle">{{number_format($item['a_price'] - $item['b_price'])}}</td>
            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['id']}}">
                <button type="button" class="btn btn-outline-dark waves-effect personal_shift" style="padding: 8px; margin: 5px;">個人別勤務表</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
