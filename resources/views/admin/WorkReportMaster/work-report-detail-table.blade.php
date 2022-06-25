<table class="table table-separate table-head-custom table-checkable" id="work_report_detail_table">
    <thead>
    <tr>
        <th rowspan="2" style="vertical-align: middle">ID</th>
        <th rowspan="2" style="vertical-align: middle">氏名</th>
        <th rowspan="2" style="vertical-align: middle">職責</th>
        <th colspan="2" class="text-center">出勤</th>
        <th colspan="2" class="text-center">退勤</th>
        <th rowspan="2" style="vertical-align: middle">認定残業時間</th>
    </tr>
    <tr>
        <th>時間</th>
        <th>場所</th>
        <th>時間</th>
        <th>場所</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$index+1}}</td>
            <td class="p-0 border text-center align-middle">{{$item->user->name}}</td>
            <td class="p-0 border text-center align-middle">{{contractType($item->user->contract_type)}}</td>
            <td class="p-0 border text-center align-middle">{{date('H:i', strtotime($item->start_time))}}</td>
            <td class="p-0 border text-center align-middle">{{$item->start_place}}</td>
            <td class="p-0 border text-center align-middle">{{date('H:i', strtotime($item->end_time))}}</td>
            <td class="p-0 border text-center align-middle">{{$item->end_place}}</td>
            <td class="p-0 border text-center align-middle">{{(int)$item->over_time}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
