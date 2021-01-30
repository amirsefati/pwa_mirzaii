@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تنظیمات برنامه
            </div>

            <div class="card-body">
            <form action="/manager/add_setttings" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        در این بخش میتوانید با وارد کردن عنوان هر آیتم، تغییرات را اعمال کنید
                    </div>
                   
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="name">عنوان تنظیم :</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-5">
                        <label for="value">مقدار تنظیم :</label>
                        <input type="text" class="form-control" name="value">
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-warning pr-5 pl-5">ثبت</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                لیست تنظیمات
            </div>
            <div class="card-body">
                <table class="table table-light">
                    <thead class="thead-light">
                        <tr>
                            <th>عنوان</th>
                            <th>مقدار</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($configs as $c)
                            <tr>
                                <td>{{$c->name}}</td>
                                <td>{{$c->value}}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="color:gray;font-size:9px">برای اپدیت از مقادیر ثبت شده استفاده کنید</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection