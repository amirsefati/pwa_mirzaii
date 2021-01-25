@extends('dashboard.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header">
                افزودن اعتبار
            </div>
            <form action="/manager/add_credit_touser_byadmin" method="POST">
                @csrf
                <input type="text" name="id" value="{{$user->id}}" hidden>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">نام کاربر : </label>
                            <input disabled type="text" class="form-control" name="name" value="{{$user->name}}">
                        </div>

                        <div class="col-md-6">
                            <label for="phone">شماره تلفن :</label>
                            <input disabled type="text" class="form-control" name="phone" value="{{$user->phone}}">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="code_meli">کد ملی :</label>
                            <input disabled type="text" class="form-control" name="code_meli" value="{{$user->code_meli}}">
                        </div>



                        <div class="col-md-3">
                            <label for="kind"> نوع کاربری :</label>
                            <input type="text" id="kind_user" value="{{$user->kind}}" hidden>
                            <select name="kind" class="form-control" disabled>
                                <option value="{{$user->kind}}">
                                    @if($user->kind === '0')
                                    دانشجوی دانشکده فنی
                                    @elseif($user->kind === '1')
                                    دانشجوی غیر دانشکده فنی
                                    @elseif($user->kind === '2')
                                    اساتید و کارکنان دانشکده فنی
                                    @elseif($user->kind === '3')
                                    اساتید و کارکنان غیر دانشکده فنی
                                @elseif($user->kind === '4')
                                    عادی
                                    @endif
                                    (انتخاب کاربر)
                                </option>
                                <option value="0">دانشجوی دانشکده فنی</option>
                                <option value="1">دانشجوی غیر دانشکده فنی</option>
                                <option value="2">اساتید و کارکنان دانشکده فنی</option>
                                <option value="3">اساتید و کارکنان غیر دانشکده فنی</option>
                                <option value="4">عادی</option>

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="email"> ایمیل :</label>
                            <input type="text" class="form-control" name="email" value="{{$user->email}}" disabled>
                        </div>

                        <div class="col-md-3">
                            <label for="has_gun">دارای سلاح :</label>
                            <input type="text" name="has_gun_id" id="has_gun" value="{{$user->has_gun}}" hidden>
                            <select name="has_gun" class="form-control"  disabled>
                                <option value="{{$user->has_gun}}">{{$user->has_gun ? 'اسلحه دارد' : 'اسلحه ندارد'}} (انتخاب کاربر)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-5" >
                        <div class="col-md-6 col-6">
                            <label for="has_gun">با سلاح :</label>
                            <input id="with_gun" type="number" name="has_gun" class="form-control" placeholder="{{$user->creadit_has_gun}}" required>
                        </div>

                        <div class="col-md-6 col-6">
                            <label for="has_gun">بدون سلاح :</label>
                            <input id="no_gun" type="number" name="no_gun" class="form-control" placeholder="{{$user->creadit_no_gun}}" required>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            قیمت پایه : <span id="price_base"></span><br><br>
                            تخفیف : <span id="price_off"></span><br><br>    
                            قیمت کل : <span id="price_total"></span>
                            <input type="text" name="price" id="price_input" hidden>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-12" style="text-align:center">
                            <button class="btn btn-success pl-5 pr-5"> آپدیت </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection