<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">管理者追加</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">人事マスター</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">管理者管理</a>
                            </li>
                            <li class="breadcrumb-item active">管理者追加
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
                            <h4 class="card-title">管理者追加</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" id="admin_save">
                                @csrf
                                <div class="row">

                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="name">名前</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="user"></i></span>
                                                <input type="text" id="name" class="form-control" name="name" placeholder="名前を入力してください" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="phone">電話番号</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="smartphone"></i></span>
                                                <input type="number" id="phone" class="form-control" name="phone" placeholder="電話番号を入力してください" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="email">メールアドレス</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="mail"></i></span>
                                                <input type="email" id="email" class="form-control" name="email" placeholder="メールアドレスを入力してください" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="password">パスワード</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i data-feather="lock"></i></span>
                                                <input type="password" id="password" class="form-control" name="password" placeholder="パスワードを入力してください" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12">
                                        <div class="mb-1">
                                            <label class="form-label" for="role">権限</label>
                                            <select class="form-select" id="role" name="role">
                                                <option value="super">スーパー管理者</option>
                                                <option value="admin">事務職管理者</option>
                                            </select>
                                        </div>
                                    </div>
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
        let admin_save = '{{route('master.person-admin-save')}}';
        $(document).ready(function () {
            $('.btn_submit').click(function (e) {
                e.preventDefault();
                saveForm('admin_save', admin_save)
            })
        })
    </script>
</x-admin-layout>
