<table class="table table-separate table-head-custom table-checkable" id="work_report_table">
    <thead>
    <tr>
        <th>氏名</th>
        <th>職責</th>
        <th>申し込み金額</th>
        <th>状況</th>
        <th>日時</th>
        <th width="200"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{$item->user->name}}</td>
            <td>{{contractType($item->user->contract_type)}}</td>
            <td>{{number_format($item->payment)}}円</td>
            <td>{{$item->status == 0 ? '申請中' : '支払い済み'}}</td>
            <td>{{date('Y-m-d', strtotime($item->created_at))}}</td>
            <td>
                @if($item->status == 0)
                    <button type="button" class="btn btn-success waves-effect waves-float waves-light btn_pay" data-id="{{$item->id}}">支払い済み</button>
                    <button type="button" class="btn btn-danger waves-effect waves-float waves-light btn_cancel" data-id="{{$item->id}}">取消</button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
