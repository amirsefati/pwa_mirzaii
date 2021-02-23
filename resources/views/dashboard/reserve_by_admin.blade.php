@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                رزرو توسط مدیر
            </div>
            <div class="card-body">
                <form action="/manager/reserved_by_admin" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label for="kind_operation"> نوع عملیات :</label>
                        <select name="kind_operation" class="form-control" id="">
                            <option value="رزرو مدیریت">توسط مدیر</option>
                        </select>
                    </div>

                    <div class="col-md-5">
                        <label for="kind"> کاربری  :</label>
                        <select class="form-control" name="kind_etc3" id="kind">
                            <option value="4">عادی</option>
                            <option value="0">دانشجوی دانشکده فنی</option>
                            <option value="1">دانشجوی غیر دانشکده فنی</option>
                            <option value="2">اساتید و کارکنان دانشکده فنی</option>
                            <option value="3">اساتید و کارکنان غیر دانشکده فنی</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="gun">مالکیت اسلحه :</label>
                        <select name="gun" class="form-control" id="reserve_by_admin_select" required>
                            <option > انتخاب کنید ...</option>
                            <option value="0">اسلحه ندارد</option>
                            <option value="1">اسلحه دارد</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <label for="info">اطلاعات رزرو کننده :</label>
                        <input type="text" name="info"  class="form-control" placeholder="نام-کدملی-شماره تلفن" required>
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="price">قیمت :</label>
                        <input type="text" name="price" id="price_reserve" class="form-control" readonly required>
                    </div>

                    <div class="col-md-4">
                        <label for="etc">ساعت رزرو :</label>
                        <input type="text" name="etc1" class="form-control" value="00-00-1399 () -> ساعت () ">
                        <small>مثال :  1399-11-19 (یکشنبه) -> ساعت (9:30-11)</small><br>
                        <small>مثال : 1399-11-15 (چهارشنبه) -> ساعت (8-9:30)</small>
                    </div>

                    <div class="col-md-4 pt-1" style="text-align:center">
                        <button class="btn btn-success mt-4 pr-5 pl-5">ثبت رزرو جلسه و پرداخت</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection