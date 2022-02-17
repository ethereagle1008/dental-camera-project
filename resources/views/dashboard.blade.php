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
                                <button type="button" class="btn btn-rounded btn-success box-shadow-2 mb-2 mr-4 btn_arrive" style="width: 110px;">出勤</button>
                                <button type="button" class="btn btn-rounded btn-danger box-shadow-2 mb-2 ml-4 btn_leave" style="width: 110px">退勤</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <a href="{{route('pay-request')}}" type="button" class="btn btn-rounded btn-primary box-shadow-2 mb-2 mr-4" style="width: 110px;">
                                    前借申請</a>
                                <a href="{{route('daily-report')}}" type="button" class="btn btn-rounded btn-secondary box-shadow-2 mb-2 ml-4" style="width: 110px;">
                                    工事報告</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let arrive = '{{route('arrive')}}';
        let leave = '{{route('leave')}}';
    </script>
    <script src="{{asset('/')}}js/dashboard.js"></script>
</x-app-layout>
