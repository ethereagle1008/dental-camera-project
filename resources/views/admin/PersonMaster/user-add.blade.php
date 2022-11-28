<x-admin-layout>
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">ユーザー追加</h2>
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
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">氏名</label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="氏名を入力してください" value="{{isset($user) ? $user->name : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">フリガナ</label>
                                        <input type="text" id="furi" class="form-control" name="furi" placeholder="フリガナを入力してください" value="{{isset($user) ? $user->furi : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">メールアドレス</label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="メールアドレスを入力してください"
                                               value="{{isset($user) ? $user->email : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="phone">パスワード</label>
                                        <input type="password" id="phone" class="form-control" name="password"
                                               placeholder="{{isset($user) ? '******' : 'パスワードを入力してください'}}" {{isset($user) ? '' : 'required'}}/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="birthday">生年月日</label>
                                        <input type="text" id="birthday" class="form-control flatpickr-basic" name="birthday" placeholder="YYYY-MM-DD"
                                               value="{{isset($user) ? $user->birthday : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="contract_type">性別</label>
                                        <select class="form-select" id="gender" name="gender">
                                            <option value="1" {{isset($user) ? ($user->gender == 1 ? 'selected' : '') : 'selected'}}>男性</option>
                                            <option value="2" {{isset($user) ? ($user->gender == 2 ? 'selected' : '') : ''}}>女性</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="contract_type">血液型</label>
                                        <select class="form-select" id="blood" name="blood">
                                            <option value="1" {{isset($user) ? ($user->blood == 1 ? 'selected' : '') : 'selected'}}>A</option>
                                            <option value="2" {{isset($user) ? ($user->blood == 2 ? 'selected' : '') : ''}}>B</option>
                                            <option value="1" {{isset($user) ? ($user->blood == 3 ? 'selected' : '') : ''}}>O</option>
                                            <option value="2" {{isset($user) ? ($user->blood == 4 ? 'selected' : '') : ''}}>AB</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="phone">住所</label>
                                        <input type="number" id="phone" class="form-control" name="address" placeholder="住所を入力してください"
                                               value="{{isset($user) ? $user->address : ''}}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="emergency_name">緊急連絡先　氏名</label>
                                        <input type="text" id="emergency_name" class="form-control" name="emergency_name" placeholder="緊急連絡先　氏名を入力してください"
                                               value="{{isset($user) ? $user->emergency_name : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="emergency_number">緊急連絡先　TEL</label>
                                        <input type="number" id="emergency_number" class="form-control" name="emergency_number" placeholder="緊急連絡先　TELを入力してください"
                                               value="{{isset($user) ? $user->emergency_number : ''}}" />
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="phone">個人連絡先TEL</label>
                                        <input type="number" id="phone" class="form-control" name="phone" placeholder="個人連絡先TELを入力してください"
                                               value="{{isset($user) ? $user->phone : ''}}" />
                                    </div>
                                </div>
                                <div class="content-header">
                                    <h5 class="my-1">契約情報:</h5>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="contract_type">契約タイプ</label>
                                        <select class="form-select" id="contract_type" name="contract_type">
                                            <option value="1" {{isset($user) ? ($user->contract_type == 1 ? 'selected' : '') : ''}}>一般</option>
                                            <option value="3" {{isset($user) ? ($user->contract_type == 3 ? 'selected' : '') : ''}}>班長</option>
                                            <option value="4" {{isset($user) ? ($user->contract_type == 4 ? 'selected' : '') : ''}}>所長</option>
                                            <option value="5" {{isset($user) ? ($user->contract_type == 5 ? 'selected' : '') : ''}}>その他</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="contract_value">日当</label>
                                        <input type="number" id="contract_value" class="form-control" name="contract_value" placeholder="日当を入力してください"
                                        value="{{isset($user) ? $user->contract_value : ''}}" required/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="move_value">出張手当</label>
                                        <input type="number" id="move_value" class="form-control" name="move_value" placeholder="出張手当を入力してください"
                                               value="{{isset($user) ? $user->move_value : '1500'}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="guarantee_day">保証日数</label>
                                        <input type="number" id="guarantee_day" class="form-control" name="guarantee_day" placeholder="保証日数を入力してください"
                                               value="{{isset($user) ? $user->guarantee_day : '20'}}"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="deal_type">採用形態</label>
                                        <select class="form-select" id="deal_type" name="deal_type">
                                            <option value="1" {{isset($user) ? ($user->deal_type == 1 ? 'selected' : '') : 'selected'}}>社員</option>
                                            <option value="2" {{isset($user) ? ($user->deal_type == 2 ? 'selected' : '') : ''}}>業務委託</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="enter_date">入社日</label>
                                        <input type="text" id="enter_date" class="form-control flatpickr-basic" name="enter_date" placeholder="YYYY-MM-DD"
                                               value="{{isset($user) ? $user->enter_date : ''}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="employ_place">採用場所</label>
                                        <select class="form-select" id="employ_place" name="employ_place">
                                            <option value="1" {{isset($user) ? ($user->employ_place == 1 ? 'selected' : '') : 'selected'}}>関西</option>
                                            <option value="3" {{isset($user) ? ($user->employ_place == 2 ? 'selected' : '') : ''}}>四国</option>
                                            <option value="4" {{isset($user) ? ($user->employ_place == 3 ? 'selected' : '') : ''}}>関東</option>
                                            <option value="5" {{isset($user) ? ($user->employ_place == 4 ? 'selected' : '') : ''}}>中国</option>
                                        </select>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="payment_type">支払い形態</label>
                                        <select class="form-select" id="payment_type" name="payment_type">
                                            <option value="1" {{isset($user) ? ($user->payment_type == 1 ? 'selected' : '') : 'selected'}}>週払い</option>
                                            <option value="2" {{isset($user) ? ($user->payment_type == 2 ? 'selected' : '') : ''}}>月払い</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3" id="salary_type_area">
                                        <label class="form-label" for="salary_type">月給形態</label>
                                        <select class="form-select" id="salary_type" name="salary_type" {{isset($user) ? ($user->deal_type == 1 ? '' : 'disabled') : ''}}>
                                            <option value="1" {{isset($user) ? ($user->salary_type == 1 ? 'selected' : '') : 'selected'}}>日給月給</option>
                                            <option value="2" {{isset($user) ? ($user->salary_type == 2 ? 'selected' : '') : ''}}>月給</option>
                                        </select>
                                    </div>
                                    @if(isset($user))
                                        <div class="mb-1 col-md-3">
                                            <label class="form-label" for="exit_date">退社日</label>
                                            <input type="text" id="exit_date" class="form-control flatpickr-basic" name="exit_date" placeholder="YYYY-MM-DD"
                                                   value="{{isset($user) ? $user->exit_date : ''}}"/>
                                        </div>
                                    @endif
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
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label">受取方法: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receive_type" id="receive_type2" value="2"
                                                {{isset($user) ? ($user->receive_type == 2 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="receive_type2">銀行振込</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="receive_type" id="receive_type3" value="3"
                                                {{isset($user) ? ($user->receive_type == 3 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="receive_type2">現金</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label">車両免許: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vehicle_license" value="1"
                                                {{isset($user) ? ($user->vehicle_license == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="dormitory1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="vehicle_license" value="0"
                                                {{isset($user) ? ($user->vehicle_license == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="dormitory2">NO</label>
                                        </div>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label">重機免許: </label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="heavy_license" value="1"
                                                {{isset($user) ? ($user->heavy_license == 1 ? 'checked' : '') : 'checked'}}/>
                                            <label class="form-check-label" for="dormitory1">YES</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="heavy_license" value="0"
                                                {{isset($user) ? ($user->heavy_license == 0 ? 'checked' : '') : ''}}/>
                                            <label class="form-check-label" for="dormitory2">NO</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="dormitory">寮費</label>
                                        <input class="form-control" placeholder="" name="dormitory" value="{{isset($user) ? (int)($user->dormitory) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="helmet">ヘルメット</label>
                                        <input class="form-control" placeholder="" id="helmet" name="helmet" value="{{isset($user) ? (int)($user->helmet) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">業務用スマートホン</label>
                                        <input class="form-control" placeholder="" name="business_phone" value="{{isset($user) ? (int)($user->business_phone) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">労災保険料</label>
                                        <input class="form-control" placeholder="" name="safe_cost" value="{{isset($user) ? (int)($user->safe_cost) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">安全協力費</label>
                                        <input class="form-control" placeholder="" id="insurance_cost" name="insurance_cost" value="{{isset($user) ? (int)($user->insurance_cost) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">貸付金</label>
                                        <input class="form-control" placeholder="" name="loan" value="{{isset($user) ? (int)($user->loan) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">前払金</label>
                                        <input class="form-control" placeholder="" id="advance_pay" name="advance_pay" value="{{isset($user) ? (int)($user->advance_pay) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">昼間日額</label>
                                        <input class="form-control" placeholder="" name="daily_amount" value="{{isset($user) ? (int)($user->daily_amount) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">昼間残業代</label>
                                        <input class="form-control" placeholder="" id="overtime_amount" name="overtime_amount" value="{{isset($user) ? (int)($user->overtime_amount) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="name">夜間日額</label>
                                        <input class="form-control" placeholder="" name="night_amount" value="{{isset($user) ? (int)($user->night_amount) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">夜間残業代</label>
                                        <input class="form-control" placeholder="" id="overnight_amount" name="overnight_amount" value="{{isset($user) ? (int)($user->overnight_amount) : 0}}"/>
                                    </div>
                                    <div class="mb-1 col-md-3">
                                        <label class="form-label" for="email">完全月給</label>
                                        <input class="form-control" placeholder="" id="full_salary" name="full_salary" value="{{isset($user) ? (int)($user->full_salary) : 0}}"/>
                                    </div>
                                </div>
                                <div class="row">

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

            $('#deal_type').change(function (){
                let type = $(this).val();
                if(type == 1){
                    $('#salary_type')[0].disabled = false
                }
                else{
                    $('#salary_type')[0].disabled = true
                }
            })

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
