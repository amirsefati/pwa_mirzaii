@extends('dashboard.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">گزارش کاربری :</div>

            <div class="card-body">
            <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>پروفایل </th>
                        <th>نام کاربر </th>
                        <th> کد ملی </th>
                        <th> نوع کاربری </th>


                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{$user->scan_pic}}" width="30px" alt=""></td>

                            <td><a href="report_user_info_user/{{$user->id}}">{{$user->name}}</a></td>
                            <td>{{$user->code_meli}}</td>

                            <td>
                                @if($user->kind == 0)
                                    <p>دانشجوی دانشکده فنی</p>
                                @elseif($user->kind == 1)
                                    <p>دانشجوی غیر دانشکده فنی</p>
                                @elseif($user->kind == 2)
                                    <p>اساتید و کارکنان دانشکده فنی</p>

                                @elseif($user->kind == 3)
                                    <p> اساتید و کارکنان غیر دانشکده فنی </p>
                                
                                @elseif($user->kind == 4)
                                    <p>عادی</p>

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


@endsection()