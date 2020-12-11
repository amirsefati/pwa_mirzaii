@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تمرین های کاربر  ( {{$user->name}} )
            </div>

            <div class="card-body">
                <form action="/manager/exercise_file_upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="user_id" value="{{$user->id}}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <label for="date">تاریخ تمرین :</label>
                        <input type="text" class="form-control" name="date" required>
                    </div>

                    <div class="col-md-6">
                        <label for="tag"> تگ :</label>
                        <select name="tag" class="form-control" id="">
                            <option value="تمرین">تمرین</option>
                            <option value="رکورد">رکورد</option>

                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="file">فایل :</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <br>
                <div class="row mt-4">
                    <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-success pl-5 pr-5">ارسال فایل</button>
                    </div>
                </div>
                
                </div>
                </form>
            </div>
        </div>
    </div>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                لیست تمرین ها
            </div>
            <div class="card-body">
            <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> تاریخ </th>
                        <th> تگ </th>                        
                        <th> فایل </th>
                        <th> عملیات </th>

                    </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($user_data as $data)
                            <td>{{$data->time}}</td>
                            <td>{{$data->tag}}</td>
                            <td><a href="{{$data->file}}">
                                فایل
                                </a>
                            </td>
                            <td><a href="/manager/exercise_file_upload_dl/{{$data->id}}">حذف</a> </td>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection