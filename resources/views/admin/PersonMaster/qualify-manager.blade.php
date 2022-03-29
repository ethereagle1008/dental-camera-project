<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">資格一覧</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">人事マスター</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">資格マスター</a>
                            </li>
                            <li class="breadcrumb-item active">資格一覧
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--begin::Content-->
    <div class="content-body">
        <!-- Ajax Sourced Server-side -->
        <section id="admin-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body border-bottom">
                            <div class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                <div class="col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start">
                                    <h4 class="card-title mb-0">資格一覧</h4>
                                </div>
                                <div class="col-sm-12 col-lg-8 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="dt-buttons">
                                            <button class="dt-button add-new btn btn-primary" tabindex="0"
                                                    aria-controls="DataTables_Table_0" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modals-slide-in"><span>資格追加</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body" id="table-part">
                            <table class="datatables-ajax table table-responsive" id="admin-table">
                                <thead>
                                <tr>
                                    <th>資格コード</th>
                                    <th>資格名</th>
                                    <th>資格等級</th>
                                    <th>登録日</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!--end::Content-->
    <!-- Modal to add new user starts-->
    <div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
        <div class="modal-dialog">
            <form class="add-new-user modal-content pt-0" id="qualify_add">
                @csrf
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×
                </button>
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">資格追加</h5>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-fullname">資格名</label>
                        <input type="text" class="form-control dt-full-name" placeholder="資格名" name="store_name" required/>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-icon-default-uname">資格等級</label>
                        <input type="text" class="form-control dt-uname" placeholder="資格等級" name="store_account" required/>
                    </div>
                    <button type="submit" class="btn btn-primary me-1 data-submit" id="saveBtn">追加</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        キャンセル
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal to add new user Ends-->
</x-admin-layout>
