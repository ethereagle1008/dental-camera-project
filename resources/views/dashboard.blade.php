<x-app-layout>
    <div class="container py-2">
        <div class="row mb-5 pb-3">
            <div class="col-md-12 col-lg-12 mb-5 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter"
                 data-appear-animation-delay="600">
                <div class="card text-center">
                    <div class="card-header bg-color-grey text-6 text-uppercase font-weight-bold">
                        山大ポータル
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mb-5 text-4 font-weight-bold p-4" id="current_time" style="border: 2px solid"></h4>
                        <p id="demo"></p>
                        <div class="row pt-2">
                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="required font-weight-bold text-dark text-3">現場</label>
                                        <select data-msg-required="Please enter the subject." class="form-control" name="site" id="site" required
                                            {{isset($shift) ? 'disabled' : ''}}>
                                            <option value="">...</option>
                                            @foreach($sites as $item)
                                                <option value="{{$item->id}}" {{(isset($shift) && $shift->site_id == $item->id) ? 'selected' : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-2">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-rounded btn-success box-shadow-2 mb-2 mr-4 btn_arrive" id="btn_arrive" style="width: 110px;"
                                    {{isset($shift) ? 'disabled' : ''}}>出勤</button>
                                <button type="button" class="btn btn-rounded btn-danger box-shadow-2 mb-2 ml-4 btn_leave" id="btn_leave" data-id="{{isset($shift) ? $shift->id : ''}}" style="width: 110px"
                                    {{!isset($shift) || (isset($shift) && isset($shift->end_time)) ? 'disabled' : ''}}>退勤</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{route('pay-request')}}" type="button" class="btn btn-rounded btn-primary box-shadow-2 mb-2 mr-4" style="width: 110px;">
                                    前借申請</a>
                                @if(Auth::user()->contract_type == 3 || Auth::user()->contract_type == 4)
                                    <a href="{{route('daily-report')}}" type="button" class="btn btn-rounded btn-secondary box-shadow-2 mb-2 ml-4" style="width: 110px;">
                                        工事報告</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let shift_post = '{{route('shift-post')}}';
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBd93WWYX4ycxgrHKerT4fsV3exeFaGfi4&region=JP&language=ja&callback=initMap&v=weekly&channel=2" async></script>
    <script src="{{asset('/')}}js/dashboard.js"></script>

</x-app-layout>
