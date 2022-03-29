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
                            <li class="breadcrumb-item"><a href="#">ユーザー管理</a>
                            </li>
                            <li class="breadcrumb-item active">ユーザー追加
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
                            <h4 class="card-title">ユーザー追加</h4>
                        </div>
                        <div class="card-body">
                            <form class="form" id="user_save">
                                @csrf
                                <input type="hidden" name="user_id" value="{{isset($user) ? $user->id : ''}}">
                                <div class="content-header">
                                    <h5 class="mb-1">基本情報入力:</h5>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="name">氏名</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">フリガナ</label>
                                        <input type="email" id="furi" class="form-control" name="furi" placeholder="フリガナを入力してください" value="{{isset($user) ? $user->furi : ''}}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">性別: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender1" value="1"
                                                {{isset($user) ? ($user->gender == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="gender1">男性</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="gender2" value="2"
                                                {{isset($user) ? ($user->gender == 2 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="gender2">女性</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">血液型: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood" id="blood1" value="1"
                                                {{isset($user) ? ($user->blood == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="blood1">A</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood" id="blood2" value="2"
                                                {{isset($user) ? ($user->blood == 2 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="blood2">B</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood" id="blood3" value="3"
                                                {{isset($user) ? ($user->blood == 3 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="blood3">O</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="blood" id="blood4" value="4"
                                                {{isset($user) ? ($user->blood == 4 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="blood4">AB</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="birthday">生年月日</label>
                                        <input type="text" id="birthday" class="form-control flatpickr-basic" name="birthday" placeholder="YYYY-MM-DD"
                                               value="{{isset($user) ? $user->birthday : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="phone">個人連絡先TEL</label>
                                        <input type="number" id="phone" class="form-control" name="phone" placeholder="個人連絡先TELを入力してください"
                                               value="{{isset($user) ? $user->phone : ''}}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">メールアドレス</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="メールアドレスを入力してください"
                                               value="{{isset($user) ? $user->email : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="phone">個人連絡先TEL</label>
                                        <input type="number" id="phone" class="form-control" name="phone" placeholder="個人連絡先TELを入力してください"
                                               value="{{isset($user) ? $user->phone : ''}}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="emergency_name">緊急連絡先　氏名</label>
                                        <input type="text" id="emergency_name" class="form-control" name="emergency_name" placeholder="緊急連絡先　氏名を入力してください"
                                               value="{{isset($user) ? $user->emergency_name : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="emergency_number">緊急連絡先　TEL</label>
                                        <input type="number" id="emergency_number" class="form-control" name="emergency_number" placeholder="緊急連絡先　TELを入力してください"
                                               value="{{isset($user) ? $user->emergency_number : ''}}" />
                                    </div>
                                </div>
                                <div class="content-header">
                                    <h5 class="my-1">資格情報:</h5>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="contract_type">契約タイプ</label>
                                        <select class="form-select" id="contract_type" name="contract_type">
                                            <option value="1" {{isset($user) ? ($user->contract_type == 1 ? 'selected' : '') : ''}}>一般A</option>
                                            <option value="2" {{isset($user) ? ($user->contract_type == 2 ? 'selected' : '') : ''}}>一般B</option>
                                            <option value="3" {{isset($user) ? ($user->contract_type == 3 ? 'selected' : '') : ''}}>班長</option>
                                            <option value="4" {{isset($user) ? ($user->contract_type == 4 ? 'selected' : '') : ''}}>所長</option>
                                            <option value="5" {{isset($user) ? ($user->contract_type == 5 ? 'selected' : '') : ''}}>その他</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="director_id">日当</label>
                                        <select class="form-select" id="director_id" name="director_id">
                                            <option value="1">12,000円</option>
                                            <option value="2">13,500円</option>
                                            <option value="3">15,000円</option>
                                            <option value="4">15,000円</option>
                                            <option value="5">18,000円</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="office_id">営業所</label>
                                        <select class="form-select" id="office_id" name="office_id">
                                            <option value="1">一般A</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="team_id">班</label>
                                        <select class="form-select" id="team_id" name="team_id">
                                            <option value="1">12,000円</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="pring_number">pring携帯番号</label>
                                        <input type="text" id="pring_number" class="form-control" name="pring_number" placeholder="pring携帯番号を入力してください"
                                               value="{{isset($user) ? $user->pring_nmber : ''}}"/>
                                    </div>
                                </div>
                                <div class="content-header">
                                    <h5 class="my-1">控除・貸与品情報:</h5>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">寮: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dormitory" id="dormitory1" value="1"
                                                {{isset($user) ? ($user->dormitory == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="dormitory1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="dormitory" id="dormitory2" value="0"
                                                {{isset($user) ? ($user->dormitory == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="dormitory2">NO</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">作業服: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="cloth" id="cloth1" value="1"
                                                {{isset($user) ? ($user->cloth == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="cloth1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="cloth" id="cloth2" value="0"
                                                {{isset($user) ? ($user->cloth == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="cloth2">NO</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">業務用スマートホン: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_phone" id="business_phone1" value="1"
                                                {{isset($user) ? ($user->business_phone == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="business_phone1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="business_phone" id="business_phone2" value="0"
                                                {{isset($user) ? ($user->business_phone == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="business_phone2">NO</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">一人親方労災保険: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="insurance" id="insurance1" value="1"
                                                {{isset($user) ? ($user->insurance == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="insurance1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="insurance" id="insurance2" value="0"
                                                {{isset($user) ? ($user->insurance == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="insurance2">NO</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="name">労災保険料</label>
                                            <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}"/>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="email">安全協力費</label>
                                            <input type="email" id="furi" class="form-control" name="furi" placeholder="フリガナを入力してください" value="{{isset($user) ? $user->furi : ''}}" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="name">貸付金</label>
                                            <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}"/>
                                        </div>
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="email">前払金</label>
                                            <input type="email" id="furi" class="form-control" name="furi" placeholder="フリガナを入力してください" value="{{isset($user) ? $user->furi : ''}}" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-1 col-md-6">
                                            <label class="form-label" for="name">受取方法※基本はpring</label>
                                            <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}"/>
                                        </div>
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
            $('.flatpickr-basic').flatpickr();
        })
    </script>
</x-admin-layout>
