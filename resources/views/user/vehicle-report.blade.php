<x-app-layout>
    <div class="container py-2">
        <div class="row pb-3">
            <div class="col-md-12 col-lg-12 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter"
                 data-appear-animation-delay="600">
                <div class="card text-center">
                    <div class="card-header bg-color-grey text-6 text-uppercase font-weight-bold">
                        車両報告
                    </div>
                    <div class="card-body">
                        <form id="report_form">
                            @csrf
                            <div class="row pt-2">
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-5">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type" id="inlineRadio1" value="1" checked />
                                                <label class="form-check-label" for="inlineRadio1">自社経費</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="report_type" id="inlineRadio2" value="2" />
                                                <label class="form-check-label" for="inlineRadio2">元請請求分</label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="required font-weight-bold text-dark text-3">現場</label>
                                            <select data-msg-required="Please enter the subject." class="form-control" name="site_id" id="site_id" required>
                                                <option value="">...</option>
                                                @foreach($sites as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="required font-weight-bold text-dark text-3">車両</label>
                                            <select data-msg-required="Please enter the subject." class="form-control" name="vehicle_id" id="vehicle_id" required>
                                                <option value="">...</option>
                                                @foreach($vehicles as $item)
                                                    <option value="{{$item->id}}">{{$item->number}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label" style="width: 30%">ETC高速代</label>
                                                        <div class="col-sm-9" style="width: 70%">
                                                            <input type="number" class="form-control" id="colFormLabel" name="etc_value" placeholder=""/>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">ETC適用</label>
                                                        <div class="col-sm-9">
                                                            <textarea type="text" class="form-control" id="colFormLabel" name="etc_apply"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label" style="width: 30%">ガソリン代</label>
                                                        <div class="col-sm-9" style="width: 70%">
                                                            <input type="number" class="form-control" id="colFormLabel" name="oil_value" placeholder=""/>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">ガソリン適用</label>
                                                        <div class="col-sm-9">
                                                            <textarea type="text" class="form-control" id="colFormLabel" name="oil_apply" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label" style="width: 30%">駐車場代</label>
                                                        <div class="col-sm-9" style="width: 70%">
                                                            <input type="number" class="form-control" id="colFormLabel" name="parking_value" placeholder=""/>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">駐車場適用</label>
                                                        <div class="col-sm-9">
                                                            <textarea type="text" class="form-control" id="colFormLabel" name="parking_apply" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-5">
                                                <div class="col-12">
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label" style="width: 30%">その他経費</label>
                                                        <div class="col-sm-9" style="width: 70%">
                                                            <input type="number" class="form-control" id="colFormLabel" name="other_value" placeholder=""/>
                                                        </div>
                                                    </div>
                                                    <div class="mb-1 row">
                                                        <label for="colFormLabel" class="col-sm-3 col-form-label">その他経費適用</label>
                                                        <div class="col-sm-9">
                                                            <textarea type="text" class="form-control" id="colFormLabel" name="other_apply" placeholder=""></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-rounded btn-success box-shadow-2 mb-2 mr-4" style="width: 110px;"
                                            onclick="window.history.back()">キャンセル</button>
                                    <button type="button" id="btn_report" class="btn btn-rounded btn-danger box-shadow-2 mb-2 ml-4" style="width: 110px">車両報告</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let vehicle_report_post = '{{route('vehicle-report-post')}}';
        $('#btn_report').click(function (e) {
            e.preventDefault();
            if ($('#site_id').val() != '' && $('#vehicle_id').val() != '') {
                var paramObj = new FormData($('#report_form')[0]);
                $.ajax({
                    url: vehicle_report_post,
                    type: 'post',
                    data: paramObj,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response.status == true) {
                            toastr.success("成功しました。");
                        } else {
                            toastr.warning("失敗しました。");
                        }
                    },
                });
            }
        })
    </script>
</x-app-layout>
