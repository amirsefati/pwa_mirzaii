@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تعریف کد تخفیف
            </div>

            <div class="card-body">
                <form action="/manager/add_coupen" method="POST">@csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">عنوان کد تخفیف :</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>

                        <div class="col-md-4">
                            <label for="kind">نوع کد تخفیف :</label>
                            <select name="kind" class="form-control" id="">
                                <option value="amount">مقداری</option>
                                <!-- <option value="percent">درصدی</option> -->

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="value">مقدار (تومان)  : </label>
                            <input type="text" name="value" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="from">اعتبار کد از تاریخ :</label>
                            <input type="date" name="from" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label for="to">اعتبار کد تا تاریخ :</label>
                            <input type="date" name="to" class="form-control" required>
                        </div>

                        <div class="col-md-3">
                            <label for="count">تعداد استفاده از کد</label>
                            <input type="number" name="count" class="form-control" value="1">
                        </div>

                        <div class="col-md-3">
                            <label for="kind_user">مختص کاربران :</label>
                            <select name="kind_user" class="form-control" id="">
                                <!-- <option value="0">دانشجوی دانشکده فنی</option>
                                <option value="1">دانشجوی غیر دانشکده فنی</option>
                                <option value="2">اساتید و کارکنان دانشکده فنی</option>
                                <option value="3">اساتید و کارکنان غیر دانشکده فنی</option>-->
                                <option value="4" selected>عادی</option> 

                            </select>
                        </div>
                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5">ثبت کد تخفیف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">   
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    لیست کد های تخفیف
                </div>

                <div class="card-body">
                <div style="overflow-x: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th style="width: 5%;">اعتبار</th>
                        <th style="width: 10%;">نام کد تخفیف</th>
                        <th style="width: 10%;">مقدار</th>
                        <th style="width: 10%;">تعداد استفاده</th>
                        <th style="width: 10%;">مختص کابران</th>
                        <th style="width: 10%;">متعبر تا</th>

                        <th style="width: 5%;">حذف</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupen  as $c)
                            <tr>
                            <td>{{(date($c->to) > today()->format('Y-m-d')) ? 'معتبر' : 'منقضی'}}</td>
                            <td>{{$c->name}}</td>
                            <td>{{$c->value}}</td>
                            <td>{{$c->count}}</td>
                            <td>
                            @if($c->kind_user == 0)
                                    <p>دانشجوی دانشکده فنی</p>
                                @elseif($c->kind_user == 1)
                                    <p>دانشجوی غیر دانشکده فنی</p>
                                @elseif($c->kind_user == 2)
                                    <p>اساتید و کارکنان دانشکده فنی</p>

                                @elseif($c->kind_user == 3)
                                    <p> اساتید و کارکنان غیر دانشکده فنی </p>
                                
                                @elseif($c->kind_user == 4)
                                    <p>عادی</p>

                                @endif
                            </td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($c->to))}}</td>

                            <td><a href="/manager/delete_coupen/{{$c->id}}">حذف</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>

@endsection