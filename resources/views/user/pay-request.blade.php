<x-app-layout>
    <div class="container py-2">
        <div class="row pb-3">
            <div class="col-md-12 col-lg-12 mb-lg-0 appear-animation" data-appear-animation="fadeInUpShorter"
                 data-appear-animation-delay="600">
                <div class="card text-center">
                    <div class="card-header bg-color-grey text-6 text-uppercase font-weight-bold">
                        仮払い申請
                    </div>
                    <div class="card-body">
                        <h4 class="card-title mb-5 text-4 font-weight-bold p-4" id="current_time" style="border: 2px solid"></h4>
                        <div class="row pt-2">
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-bold text-dark text-3">仮払い可能な金額</label>
                                        <p class="text-center text-5 text-dark">{{$limit}}円</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="required font-weight-bold text-dark text-3">仮払い希望金額</label>
                                        <input type="hidden" id="limit" value="{{$limit}}">
                                        <input type="number" value="0" maxlength="10" class="form-control" name="price" id="price" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-rounded btn-success box-shadow-2 mb-2 mr-4" style="width: 110px;"
                                        onclick="window.history.back()">キャンセル</button>
                                <button type="button" id="btn_request" class="btn btn-rounded btn-danger box-shadow-2 mb-2 ml-4" style="width: 110px">申請</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let pay_request_post = '{{route('pay-request-post')}}';
    </script>
    <script src="{{asset('/')}}js/pay-report.js"></script>
</x-app-layout>
