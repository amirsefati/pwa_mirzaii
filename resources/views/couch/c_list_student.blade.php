@extends('couch.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               لیست دانشجویان  ({{Auth::user()->name}})
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
                        <th>نوع عضویت</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($student as $user)
                        <tr>

                            <td><a href="/couch/c_student/{{$user->id}}">{{$user->name}}</a></td>
                            <td>{{$user->code_meli}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($user->created_at))}}</td>
                            <td>
                                @if($user->kind == 0)
                                    <p>کاربر عادی</p>
                                @elseif($user->kind == 1)
                                    <p>دانشگاه غیر  تهران</p>
                                @elseif($user->kind == 2)
                                    <p>دانشگاه تهران</p>

                                @elseif($user->kind == 3)
                                    <p>استاد یا کارمند</p>
                                @endif
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