<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">現場追加</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">現場マスター</a>
                            </li>
                            <li class="breadcrumb-item active">現場追加
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--begin::Content-->
    <div class="content-body">
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">現場追加</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" id="saveForm">
                                @csrf
                                <input type="hidden" name="id" value="{{isset($data) ? $data->id : ''}}">
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="name">現場名</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="現場名を入力してください"
                                               value="{{isset($data) ? $data->name : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="address">現場住所</label>
                                        <input type="text" id="address" class="form-control" name="address" placeholder="現場住所を入力してください"
                                               value="{{isset($data) ? $data->address : ''}}" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="latitude">緯度</label>
                                        <input type="text" id="latitude" class="form-control" name="latitude" placeholder="緯度を入力してください"
                                               value="{{isset($data) ? $data->latitude : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="longitude">経度</label>
                                        <input type="text" id="longitude" class="form-control" name="longitude" placeholder="経度を入力してください"
                                               value="{{isset($data) ? $data->longitude : ''}}" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="contact">担当者名</label>
                                        <input type="text" id="contact" class="form-control" name="contact" placeholder="担当者名を入力してください"
                                               value="{{isset($data) ? $data->contact : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="site_code">占部組現場コード</label>
                                        <input type="number" maxlength="7" minlength="7" id="site_code" class="form-control" name="site_code"
                                               placeholder="占部組現場コードを入力してください" value="{{isset($data) ? $data->site_code : ''}}" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="company_id">請求先会社</label>
                                        <select class="form-select" id="company_id" name="company_id">
                                            @foreach($company as $item)
                                                <option value="{{$item->id}}" {{isset($data) ? ($data->company_id == $item->id ? 'selected' : '') : ''}}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">現場状況: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status1" value="1"
                                                {{isset($data) ? ($data->status == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="gender1">進行中
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status" id="status2" value="0"
                                                {{isset($data) ? ($data->status == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="gender2">終了</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="reset" class="btn btn-primary me-1 btn_submit">登録</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
    <script>
        let admin_save = '{{route('master.site-save')}}';
        $(document).ready(function () {
            $('.btn_submit').click(function (e) {
                e.preventDefault();
                saveForm('saveForm', admin_save)
            })
        })
    </script>
</x-admin-layout>
