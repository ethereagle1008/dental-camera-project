<x-admin-layout>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">ユーザー追加</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <!--begin::Search Form-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">ユーザーの詳細情報を入力して送信します</span>
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
                                            <form class="form" id="kt_form">
                                                <div class="row justify-content-center">
                                                    <div class="col-xl-6 px-5">
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="my-0 step">
                                                            <h5 class="text-dark font-weight-bold mb-10">基本情報入力:</h5>
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">氏名</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" name="name" type="text" value="" />
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">フリガナ</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="text" value="">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">性別</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios2">
                                                                            <span></span>男性</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios2">
                                                                            <span></span>女性</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">血液型</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios1">
                                                                            <span></span>A</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios1">
                                                                            <span></span>B</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios1">
                                                                            <span></span>O</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios1">
                                                                            <span></span>AB</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">生年月日</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="date" value="" id="example-date-input">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">個人連絡先TEL</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="tel" value="">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">メールアドレス</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="email" value="">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">緊急連絡先　氏名</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" name="name" type="text" value="" />
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">緊急連絡先　TEL</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="tel" value="">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        </div>
                                                        <!--end::Wizard Step 1-->
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="py-5 step border-top">
                                                            <h5 class="text-dark font-weight-bold mb-10">資格情報:</h5>
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">契約タイプ</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">日当</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>12,000円</option>
                                                                        <option>13,500円</option>
                                                                        <option>15,000円</option>
                                                                        <option>15,000円</option>
                                                                        <option>18,000円</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">紹介した所長</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">営業所</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        </div>
                                                        <!--end::Wizard Step 1-->
                                                    </div>
                                                    <div class="col-xl-6 px-5">
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="my-0 step">
                                                            <h5 class="text-dark font-weight-bold mb-10">契約情報:</h5>
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">契約タイプ</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">日当</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>12,000円</option>
                                                                        <option>13,500円</option>
                                                                        <option>15,000円</option>
                                                                        <option>15,000円</option>
                                                                        <option>18,000円</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">紹介した所長</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">営業所</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">班</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control form-control-solid form-control-lg" id="exampleSelectd">
                                                                        <option>一般A</option>
                                                                        <option>一般B</option>
                                                                        <option>班長</option>
                                                                        <option>所長</option>
                                                                        <option>その他</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">pring携帯番号</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control form-control-solid form-control-lg" type="tel" value="">
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        </div>
                                                        <!--end::Wizard Step 1-->
                                                        <!--begin::Wizard Step 1-->
                                                        <div class="py-5 step border-top">
                                                            <h5 class="text-dark font-weight-bold mb-10">控除・貸与品情報:</h5>
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">寮</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios6">
                                                                            <span></span>YES</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios6">
                                                                            <span></span>NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">作業服</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios7">
                                                                            <span></span>YES</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios7">
                                                                            <span></span>NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">業務用スマートホン</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios8">
                                                                            <span></span>YES</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios8">
                                                                            <span></span>NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">一人親方労災保険</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios9">
                                                                            <span></span>YES</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios9">
                                                                            <span></span>NO</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                            <!--begin::Group-->
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">受取方法</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <div class="radio-inline mt-2">
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios10">
                                                                            <span></span>pring受取</label>
                                                                        <label class="radio">
                                                                            <input type="radio" name="radios10">
                                                                            <span></span>銀行振込</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--end::Group-->
                                                        </div>
                                                        <!--end::Wizard Step 1-->
                                                        <!--begin::Wizard Actions-->
                                                        <div class="justify-content-between border-top pt-10">
                                                            <div class="text-right">
                                                                <button type="button" class="btn btn-success font-weight-bolder px-9 py-4">登録</button>
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
</x-admin-layout>
