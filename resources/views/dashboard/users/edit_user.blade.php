@extends('dashboard.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-5">
            <div class="card-header">
                اعتبار سنجی کاربر
            </div>
            <form action="/manager/verify_user_account" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="id" value="{{$user->id}}" hidden>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">نام کاربر : </label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </div>

                    <div class="col-md-6">
                        <label for="phone">شماره تلفن :</label>
                        <input type="text" class="form-control" name="phone"  value="{{$user->phone}}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="code_meli">کد ملی :</label>
                        <input type="text" class="form-control" name="code_meli"  value="{{$user->code_meli}}">
                    </div>

                    <div class="col-md-3">
                        <label for="born"> تاریخ تولد :</label>
                        <input type="text" class="form-control" name="born"  value="{{$user->born}}">
                    </div>

                    <div class="col-md-3">
                        <label for="kind"> نوع کاربری  :</label>
                        <select name="kind" class="form-control" id="">
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
                        <input type="text" class="form-control" name="email"  value="{{$user->email}}">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="has_gun">دارای سلاح :</label>
                        <select name="has_gun" class="form-control" id="">
                            <option value="{{$user->has_gun}}">{{$user->has_gun ? 'اسلحه دارد' : 'اسلحه ندارد'}} (انتخاب کاربر)</option>
                            <option value="0">اسلحه ندارد</option>
                            <option value="1">اسلحه دارد</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="created_at">تاریخ عضویت :</label>
                        <input type="text" class="form-control" value="{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($user->created_at))}}" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="password"> پسورد :</label>
                        <input type="password" class="form-control" id="pwsrd" name="password" value="{{$user->password}}">
                        <small onclick="show_pass()" style="color:grey">نمایش</small>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-4" style="text-align: center;">
                        <div class="border_dash p-3">
                        <p> اسکن کارت ملی </p>
                        <img src="{{$user->scan_shenasname}}" width="100%" alt="">
                        <input type="file" name="scan_shenasname_n">
                        <input style="display: none;" type="text" name="scan_shenasname" value="{{$user->scan_shenasname}}">
                        </div>
                    </div>

                    <div class="col-md-4" style="text-align: center;">
                        <div class="border_dash p-3">
                        <p>اسکن عکس پرسنلی</p>
                        <img src="{{$user->scan_pic}}" width="100%" alt="">
                        <input type="file" name="scan_pic_n">
                        <input style="display: none;" type="text" name="scan_pic" value="{{$user->scan_pic}}">
                        </div>
                    </div>

                    <div class="col-md-4" style="text-align: center;">
                        <div class="border_dash p-3">
                        <p>اسکن کارت بیمه</p>
                        <img src="{{$user->scan_bime}}" width="100%" alt="">
                        <input type="file" name="scan_bime_n">
                        <input style="display: none;" type="text" name="scan_bime" value="{{$user->scan_bime}}">

                        </div>
                    </div>

                    <div class="col-md-4" style="text-align: center;">
                        <div class="border_dash p-3">
                        <p> کارت دانشجویی </p>
                        <img src="{{$user->etc2}}" width="100%" alt="">
                        <input type="file" name="etc2_n">
                        <input style="display: none;" type="text" name="etc2" value="{{$user->etc2}}">

                        </div>
                    </div>

                    
                </div>

                <div class="row mt-5">
                    <div class="col-md-12" style="text-align:center">
                        <button class="btn btn-success pl-5 pr-5">تایید هویت</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection