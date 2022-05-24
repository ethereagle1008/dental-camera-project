<table class="table table-separate table-head-custom table-checkable" id="pay_sum_table">
    <thead>
    <tr>
        <th colspan="3" class="text-center">委託者情報</th>
        <th colspan="1" class="text-center">月間報酬額</th>
        <th colspan="1" class="text-center">月間前払金</th>
        <th colspan="1" class="text-center">月間控除額</th>
        <th colspan="1" class="text-center">月度支払額</th>
        <th rowspan="2" class="text-center" style="vertical-align: middle"></th>
    </tr>
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">氏名</th>
        <th class="text-center">携帯番号</th>
        <th class="text-center">（A）</th>
        <th class="text-center">（B）</th>
        <th class="text-center">（C）</th>
        <th class="text-center">（A）-（B）-（C）</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item['id']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['name']}}</td>
            <td class="p-0 border text-center align-middle">{{$item['phone']}}</td>

            <td class="p-0 border text-center align-middle">{{number_format($item['a_price'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['pre_pay'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['b_price'])}}</td>
            <td class="p-0 border text-center align-middle">{{number_format($item['a_price'] - $item['b_price'] - $item['pre_pay'])}}</td>

            <td class="p-0 border text-center align-middle">
                <input type="hidden" value="{{$item['id']}}">
                <button type="button" class="btn btn-outline-dark waves-effect person_pay" style="padding: 8px; margin: 5px;">前払金内訳</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
