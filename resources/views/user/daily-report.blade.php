<x-app-layout>
    <div class="container py-2">
        <div class="row pb-3">
            <div class="col-md-12 col-lg-12 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter"
                 data-appear-animation-delay="600">
                <div class="card text-center">
                    <div class="card-header bg-color-grey text-6 text-uppercase font-weight-bold">
                        工事報告
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-4 font-weight-bold p-4" id="current_time" style="border: 2px solid"></h4>
                        <div class="row pt-2">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="required font-weight-bold text-dark text-3">現場</label>
                                        <select data-msg-required="Please enter the subject." class="form-control" name="site" id="site" required>
                                            <option value="">...</option>
                                            @foreach($sites as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12 mb-4">
                                        <label class="required font-weight-bold text-dark text-3">報告内容テキスト</label>
                                        <textarea maxlength="1000" data-msg-required="Please enter your message." rows="5" class="form-control" name="message" id="message" required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-rounded btn-success box-shadow-2 mb-2 mr-4" style="width: 110px;"
                                        onclick="window.history.back()">キャンセル</button>
                                <button type="button" id="btn_report" class="btn btn-rounded btn-danger box-shadow-2 mb-2 ml-4" style="width: 110px">工事報告</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let daily_report_post = '{{route('daily-report-post')}}';
    </script>
    <script src="{{asset('/')}}js/daily-report.js"></script>
</x-app-layout>
