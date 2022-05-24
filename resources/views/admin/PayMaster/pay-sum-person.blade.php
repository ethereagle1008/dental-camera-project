<div class="card-header pb-0">
    <div class="row text-center">
        <div class="col-md-12 text-center">
            <h2>個人別前払表</h2>
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
                    <th>日時</th>
                    <th>金額</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tmp['history'] as $history)
                   <tr>
                       <td>{{date('Y.m.d', strtotime($history->updated_at))}}</td>
                       <td>{{number_format($history->payment)}}</td>
                   </tr>
                @endforeach
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>合計</td>
                    <td>{{$tmp['pre_pay']}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
