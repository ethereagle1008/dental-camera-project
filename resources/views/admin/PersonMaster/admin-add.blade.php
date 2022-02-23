<x-admin-layout>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">管理者追加</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">管理者の詳細を入力して送信します</span>
                    </div>
                    <!--end::Search Form-->
                </div>
                <!--end::Details-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Card-->
                <div class="card card-custom card-transparent">
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                            <!--begin::Card-->
                            <div class="card card-custom card-shadowless rounded-top-0">
                                <!--begin::Body-->
                                <div class="card-body p-0">
                                    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                        <div class="col-xl-12 col-xxl-10">
                                            <!--begin::Wizard Form-->
                                            <form class="form" id="admin_save">
                                                <div class="row justify-content-center">
                                                        @csrf
                                                        <div class="col-xl-9">
                                                            <!--begin::Wizard Step 1-->
                                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                                <h5 class="text-dark font-weight-bold mb-10">管理者詳細:</h5>
                                                                <!--begin::Group-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">名前</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control form-control-solid form-control-lg" name="name" type="text" value="" required/>
                                                                    </div>
                                                                </div>
                                                                <!--end::Group-->

                                                                <!--begin::Group-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">電話番号</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control form-control-solid form-control-lg" name="phone" type="text" value="" required/>
                                                                    </div>
                                                                </div>
                                                                <!--end::Group-->
                                                                <!--begin::Group-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">メールアドレス</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control form-control-solid form-control-lg" name="email" type="email" value="" required/>
                                                                    </div>
                                                                </div>
                                                                <!--end::Group-->
                                                                <!--begin::Group-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label">パスワード</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <input class="form-control form-control-solid form-control-lg" minlength="8" name="password" type="password"  value="" required/>
                                                                    </div>
                                                                </div>
                                                                <!--end::Group-->
                                                                <!--begin::Group-->
                                                                <div class="form-group row">
                                                                    <label class="col-xl-3 col-lg-3 col-form-label" for="exampleSelect1">権限</label>
                                                                    <div class="col-lg-9 col-xl-9">
                                                                        <select class="form-control" name="role" required>
                                                                            <option value="super">スーパー管理者</option>
                                                                            <option value="admin">事務職管理者</option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <!--end::Group-->
                                                            </div>
                                                            <!--end::Wizard Step 1-->
                                                            <!--begin::Wizard Actions-->
                                                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                                                <div>
                                                                    <button type="button" class="btn btn-success font-weight-bolder px-9 py-4 btn_submit">登録</button>
                                                                </div>
                                                            </div>
                                                            <!--end::Wizard Actions-->
                                                        </div>
                                                </div>
                                            </form>
                                            <!--end::Wizard Form-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Wizard-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>
    <!--end::Content-->
    <script>
        let admin_save = '{{route('master.admin-save')}}';
        $(document).ready(function () {
            $('.btn_submit').click(function (e) {
                e.preventDefault();
                saveForm('admin_save', admin_save)
            })
        })
    </script>
</x-admin-layout>
