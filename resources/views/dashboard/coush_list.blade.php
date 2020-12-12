@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                لیست مربی ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> کد کاربر </th>
                        <th>نام کاربر </th>
                        <th> کد ملی</th>
                        <th> تعداد دانشجو</th>
                        <th> عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($users as $user)
                        @if($user->etc == 1)
                        <tr>    
                            <td>{{$user->id}}</td>
                            <td><a href="/manager/show_couch/{{$user->id}}">{{$user->name}}</a></td>
                            <td>{{$user->code_meli}}</td>
                            <td>{{App\Models\User::where('etc1',$user->id)->count()}}</td>
                            <td>
                                <a href="/manager/to_student/{{$user->id}}">مربی</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="5" style="text-align: center;">دانشجویان</td>
                    </tr>
                    @foreach($users as $user)
                        @if($user->etc == null)
                        
                        <tr>    
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->code_meli}}</td>
                            <td>0</td>
                            <td>
                                <a href="/manager/to_couch/{{$user->id}}">دانشجو</a>
                            
                            </td>
                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection