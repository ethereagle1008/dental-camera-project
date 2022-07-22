<table class="table table-separate table-head-custom table-checkable" id="vehicle_report_detail_table" style="width: 150%">
    <thead>
    <tr>
        <th class="text-center">ID</th>
        <th class="text-center">自社OR傭車</th>
        <th class="text-center">所有者</th>
        <th class="text-center">車番</th>
        <th class="text-center">車種</th>
        <th class="text-center"></th>
        <th class="text-center">ETC高速代</th>
        <th class="text-center">摘要</th>
        <th class="text-center">ガソリン代</th>
        <th class="text-center">摘要</th>
        <th class="text-center">駐車場代</th>
        <th class="text-center">摘要</th>
        <th class="text-center">その他経費</th>
        <th class="text-center">摘要</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $index => $item)
        <tr>
            <td class="p-0 border text-center align-middle">{{$item->vehicle->id}}</td>
            <td class="p-0 border text-center align-middle">{{$item->vehicle->owner_type == 1 ? "自社" : "庸車"}}</td>
            <td class="p-0 border text-center align-middle">{{$item->vehicle->owner_type == 2 ? $item->vehicle->user->name : "会社"}}</td>
            <td class="p-0 border text-center align-middle">{{$item->vehicle->number}}</td>
            <td class="p-0 border text-center align-middle">{{$item->vehicle->type}}</td>
            <td class="p-0 border text-center align-middle">{{$item->report_type == 1 ? "自社経費" : "元請請求分"}}</td>
            <td class="p-0 border text-center align-middle">{{$item->etc_value}}</td>
            <td class="p-0 border text-center align-middle">{{$item->etc_apply}}</td>
            <td class="p-0 border text-center align-middle">{{$item->oil_value}}</td>
            <td class="p-0 border text-center align-middle">{{$item->oil_apply}}</td>
            <td class="p-0 border text-center align-middle">{{$item->parking_value}}</td>
            <td class="p-0 border text-center align-middle">{{$item->parking_apply}}</td>
            <td class="p-0 border text-center align-middle">{{$item->other_value}}</td>
            <td class="p-0 border text-center align-middle">{{$item->other_apply}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
