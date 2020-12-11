@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                ارسال اسکات برای کاربر  ( {{App\Models\User::where('id',$id)->first()->name}} )
            </div>

            <div class="card-body">
                <form action="/manager/skat_file_upload" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="user_id" value="{{$id}}" hidden>
                <div class="row">
                    <div class="col-md-6">
                        <label for="date">تاریخ اسکت :</label>
                        <input type="text" class="form-control" name="date" required>
                    </div>

                    <div class="col-md-6">
                        <label for="comment">کامنت اسکت :</label>
                        <input type="text" class="form-control" name="comment" required>
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
@endsection