<table class="table table-separate table-head-custom table-checkable" id="work_report_table">
    <thead>
    <tr>
        <th>会社名</th>
        <th>現場ID</th>
        <th>現場名</th>
        <th>発注者承認印</th>
        <th>発注者承認日</th>
        <th>山大承認印</th>
        <th>山大承認日</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{$item->site->company->name}}</td>
            <td>{{$item->site->site_code}}</td>
            <td>{{$item->site->name}}</td>
            <td>{{$item->company_approval}}</td>
            <td>{{isset($item->company_approval) ? date('Y-m-d', strtotime($item->updated_at)) : ''}}</td>
            <td>{{$item->admin_approval}}</td>
            <td>{{isset($item->admin_approval) ? date('Y-m-d', strtotime($item->updated_at)) : ''}}</td>
            <td>
                <input type="hidden" value="{{$item->site->id}}">
                <input type="hidden" value="{{date('Y年m月d日付分', strtotime($item->shift_date))}}">
                <a class="btn btn-sm btn-clean btn-icon mr-2 work_report_detail" title="Edit details">
                    <span class="svg-icon svg-icon-md">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <path
                                    d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z"
                                    fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) ">
                                </path>
                                <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"></rect>
                            </g>
                        </svg>
                    </span>
                </a>
                <button class="mt-0 btn btn-primary waves-effect waves-float waves-light confirm_report"
                            style="float:right;" >承認
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
