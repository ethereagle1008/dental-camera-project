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
                                        <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">フリガナ</label>
                                        <input type="text" id="furi" class="form-control" name="furi" placeholder="フリガナを入力してください" value="{{isset($user) ? $user->furi : ''}}" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">メールアドレス</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="メールアドレスを入力してください"
                                               value="{{isset($user) ? $user->email : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="phone">パスワード</label>
                                        <input type="password" id="phone" class="form-control" name="password"
                                               placeholder="{{isset($user) ? '******' : 'パスワードを入力してください'}}" required/>
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
                                        <label class="form-label" for="phone">住所</label>
                                        <input type="number" id="phone" class="form-control" name="address" placeholder="住所を入力してください"
                                               value="{{isset($user) ? $user->address : ''}}" />
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
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="phone">個人連絡先TEL</label>
                                        <input type="number" id="phone" class="form-control" name="phone" placeholder="個人連絡先TELを入力してください"
                                               value="{{isset($user) ? $user->phone : ''}}" />
                                    </div>
                                </div>
                                <div class="content-header">
                                    <h5 class="my-1">契約情報:</h5>
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
                                        <label class="form-label" for="contract_value">日当</label>
                                        <input type="number" id="contract_value" class="form-control" name="contract_value" placeholder="日当を入力してください"
                                        value="{{isset($user) ? $user->contract_value : ''}}" />
                                        {{-- <select class="form-select" id="contract_value" name="contract_value" disabled>
                                            <option value="1" {{isset($user) ? ($user->contract_type == 1 ? 'selected' : '') : ''}}>12,000円</option>
                                            <option value="2" {{isset($user) ? ($user->contract_type == 2 ? 'selected' : '') : ''}}>13,500円</option>
                                            <option value="3" {{isset($user) ? ($user->contract_type == 3 ? 'selected' : '') : ''}}>15,000円</option>
                                            <option value="4" {{isset($user) ? ($user->contract_type == 4 ? 'selected' : '') : ''}}>15,000円</option>
                                            <option value="5" {{isset($user) ? ($user->contract_type == 5 ? 'selected' : '') : ''}}>18,000円</option>
                                        </select> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="select2-nested">営業所-班</label>
                                        <select class="select2 form-select" id="select2-nested" name="team_id">
                                            @foreach($office as $item)
                                                <optgroup label="{{$item->name}}">
                                                    @foreach($team as $itm)
                                                        @if($itm->office_id == $item->id)
                                                            <option value="{{$itm->id}}" {{isset($user) && ($user->team_id == $itm->id) ? 'selected' : ''}}>{{$itm->name}}</option>
                                                        @endif
                                                    @endforeach
                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="pring_number">pring携帯番号</label>
                                        <input type="text" id="pring_number" class="form-control" name="pring_number" placeholder="pring携帯番号を入力してください"
                                               value="{{isset($user) ? $user->pring_nmber : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="director_id">紹介した所長</label>
                                        <select class="form-select" id="director_id" name="director_id">
                                            <option></option>
                                            @foreach($officeManager as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="content-header">
                                    <h5 class="my-1">資格情報:</h5>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="">資格</label>
                                        <select class="select2 form-select" multiple="multiple" id="default-select-multi" name="qualify[]">
                                            <?php
                                                foreach($qualify as $itm){
                                                    if(isset($user)){
                                                        $is_in = '';
                                                         foreach($user_qualify as $item){
                                                                if($item->qualify_id == $itm->id){
                                                                    $is_in = 'selected';
                                                                }
                                                         }
                                                         echo '<option value="' . $itm->id . '" ' . $is_in . '>' . $itm->name . '</option>';
                                                    }
                                                    else{
                                                        echo '<option value="' . $itm->id . '">' . $itm->name . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
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
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label">受取方法: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receive_type" id="receive_type1" value="1"
                                                {{isset($user) ? ($user->receive_type == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="receive_type1">pring受取</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receive_type" id="receive_type2" value="2"
                                                {{isset($user) ? ($user->receive_type == 2 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="receive_type2">銀行振込</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receive_type" id="receive_type3" value="3"
                                                {{isset($user) ? ($user->receive_type == 3 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="receive_type2">現金</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="name">労災保険料</label>
                                        <input class="form-control" placeholder="" name="safe_cost" value="{{isset($user) ? (int)($user->safe_cost) : 360}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">安全協力費</label>
                                        <input class="form-control" placeholder="" id="insurance_cost" name="insurance_cost" value="{{isset($user) ? (int)($user->insurance_cost) : 360}}"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="name">貸付金</label>
                                        <input class="form-control" placeholder="" name="loan" value="{{isset($user) ? (int)($user->loan) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-6">
                                        <label class="form-label" for="email">前払金</label>
                                        <input class="form-control" placeholder="" id="advance_pay" name="advance_pay" value="{{isset($user) ? (int)($user->advance_pay) : 0}}"/>
                                    </div>
                                    <div class="col-12">
                                        <button type="reset" class="btn btn-primary me-1 btn_submit">{{isset($user)? '変更' : '登録'}}</button>
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
        let admin_save = '{{route('master.person-user-save')}}';
        $(document).ready(function () {
            $('.btn_submit').click(function (e) {
                e.preventDefault();
                saveForm('user_save', admin_save)
            })
            $('.flatpickr-basic').flatpickr();

            $('#contract_type').change(function () {
                // $('#contract_value').val($(this).val());
                let type = $(this).val();
                if(type == 1){
                    $('#insurance_cost').val(360)
                }
                else if(type == 2){
                    $('#insurance_cost').val(405)
                }
                else if(type == 3 || type == 4){
                    $('#insurance_cost').val(450)
                }
                else{
                    $('#insurance_cost').val(540)
                }
            })
            $('.select2').each(function () {
                var $this = $(this);
                $this.wrap('<div class="position-relative"></div>');
                $this.select2({
                    // the following code is used to disable x-scrollbar when click in select input and
                    // take 100% width in responsive also
                    dropdownAutoWidth: true,
                    width: '100%',
                    dropdownParent: $this.parent()
                });
            });
        })
    </script>
</x-admin-layout>
