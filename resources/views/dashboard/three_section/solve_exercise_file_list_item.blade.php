@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تمرین های کاربر  ( {{App\Models\User::where('id',$item->user_id)->first()->name}} ) تمرین ({{$item->time}})
            </div>

            <div class="card-body">
                <form action="/manager/solve_exercise_file_list_item_upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="user_id" value="{{$item->user_id}}" hidden>
                <input type="text" name="comment_id" value="{{$item->id}}" hidden>

                <div class="row">
                    <div class="col-md-6">
                        <label for="date">تاریخ تمرین :</label>
                        <input type="text" class="form-control" name="date" value="{{$item->time}}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="tag"> تگ :</label>
                        <select name="tag" class="form-control" id="" disabled>
                            <option value="تمرین">تمرین</option>
                        </select>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <label for="file">فایل :</label>
                            <a href="{{$item->file}}">دانلود فایل تمرین</a>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="comment">کامنت تحلیل :</label>
                        <input type="text" name="comment" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label for="comment">فایل تحلیل :</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-12" style="text-align: center;">
                        <button class="btn btn-success pl-5 pr-5">ارسال تحلیل</button>
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
                        <th> تحیلی تمرین </th>
                        <th> تحلیل تمرین فایل </th>

                        <th> عملیات </th>

                    </tr>
                    </thead>
                    <tbody id="myTable">
                            <td>{{$item->time}}</td>
                            <td>{{$item->tag}}</td>
                            <td><a href="{{$item->file}}">تمرین</a></td>
                                @if(App\Models\Exercise_file_solve::where('exercise_files_id',$item->id)->count() > 0)
                                    <td>{{App\Models\Exercise_file_solve::where('exercise_files_id',$item->id)->first()->comment}}</td>

                                    <td>@if(strlen(App\Models\Exercise_file_solve::where('exercise_files_id',$item->id)->first()->file) > 10)
                                        <a href="{{App\Models\Exercise_file_solve::where('exercise_files_id',$item->id)->first()->file}}">تحلیل</a>
                                        @else
                                        <p>-</p>
                                        @endif
                                    </td>

                                    <td><a href="/manager/exercise_file_upload_dl_solve/{{App\Models\Exercise_file_solve::where('exercise_files_id',$item->id)->first() ->id}}">حذف</a> </td>

                                @else
                                <td>بدون تحلیل</td>
                                <td>بدون تحلیل</td>
                                <td></td>

                                @endif

                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection