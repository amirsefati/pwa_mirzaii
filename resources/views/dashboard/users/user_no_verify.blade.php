@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                کاربران تایید نشده   
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>نام کاربر </th>
                        <th>کدملی</th>
                        <th>شماره تلفن</th>
                        <th>ایمیل</th>
                        <th>تاریخ عضویت</th>
                        <th>مدارک</th>
                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($no_verify as $user)
                        <tr>

                            <td>{{$user->name}}</td>
                            <td>{{$user->code_meli}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($user->created_at))}}</td>
                            <td>
                                @if(strlen($user->scan_shenasname) > 10 )
                                    <button type="button" class="btn btn-success" data-container="body" data-toggle="popover" data-placement="left" data-content="{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($user->update_at))}}">
                                        ارسال شده
                                    </button>
                                @else
                                    <p style="color:red">ارسال نشده</p>
                                @endif
                            </td>
                            <td>
                                <a href="/manager/user/edit_user/{{$user->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>

                            </td>

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