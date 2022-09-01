<table class="table table-separate table-head-custom table-checkable" id="pay_sum_table">
    <thead>
    <tr>
        <th class="text-center">現場名</th>
        <th class="text-center">金額</th>
        <th class="text-center"></th>
    </tr>
    </thead>
    <tbody>

        @foreach($data as $index => $item)
            <tr>
                <td class="p-0 border text-center align-middle">{{$item['name']}}</td>
                <td class="p-0 border text-center align-middle"><input value="{{$item['amount']}}"></td>
                <td class="p-0 border text-center align-middle">
                    <input type="hidden" value="{{$item['id']}}">
                    <button type="button" data-id="{{$item['id']}}" class="btn btn-outline-dark waves-effect ex_change" style="padding: 8px; margin: 5px;">変更</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
