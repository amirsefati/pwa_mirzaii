@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                 مربی ({{App\Models\User::find($id)->first()->name}}) 
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" style="text-align: center;">
                        <p>مربی تیرزاندازان  ({{App\Models\User::find($id)->first()->name}})</p>
                    </div>
                </div>
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>نام کاربر </th>
                        <th> کد ملی</th>
                        <th>  نوع کاربری</th>
                        <th> عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($users as $user)
                        @if($user->etc1 == $id)
                        <tr>    
                            <td>{{$user->name}}</td>
                            <td>{{$user->code_meli}}</td>
                            <td>
                                @if($user->kind == 0)
                                    <p>دانشجوی دانشکده فنی</p>
                                @elseif($user->kind == 1)
                                    <p>دانشجوی غیر دانشکده فنی</p>
                                @elseif($user->kind == 2)
                                    <p>اساتید و کارکنان دانشکده فنی</p>

                                @elseif($user->kind == 3)
                                    <p>اساتید و کارکنان غیر دانشکده فنی</p>
                                @endif
                            </td>
                            <td>
                                <a href="/manager/dl_couch_from_student/{{$user->id}}">حدف مربی</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                   
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="card">
            <div class="card-header">
                افزودن تیرانداز
            </div>
            <form action="/manager/add_userto_couach" method="post">
            @csrf
            <input type="text" name="couch_user_id" value="{{$id}}" hidden>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                    <label for="user_id">لیست تیراندازان : </label>
                    <select name="user_id" class="form-control" required>
                        @foreach($users as $user)
                            @if($user->etc1 == null && $user->etc == null)
                                <option value="{{$user->id}}">{{$user->name}} - {{$user->code_meli}}</option>
                            @endif
                        @endforeach
                    </select>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12" style="text-align:center">
                        <button class="btn btn-success pr-5 pl-5">افزودن</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


@endsection