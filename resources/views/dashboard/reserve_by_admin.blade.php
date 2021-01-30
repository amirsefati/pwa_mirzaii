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
                    <div class="col-md-6">
                        <label for="kind_operation"> نوع عملیات :</label>
                        <select name="kind_operation" class="form-control" id="">
                            <option value="رزرو مدیریت">توسط مدیر</option>
                        </select>
                    </div>
                    <div class="col-md-6">
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
                        <input type="text" name="info"  class="form-control">
                    </div>
                </div>
                
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="price">قیمت :</label>
                        <input type="text" name="price" id="price_reserve" class="form-control" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="etc">ساعت رزرو :</label>
                        <input type="text" name="etc1" class="form-control">
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