@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">افزودن نوتیفیکشن و اخبار     </div>
            <div class="card-body">
                <form action="/manager/add_noti_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان :</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="link"> موضوع :</label>
                            <select name="link" class="form-control" id="">
                                <option value="news">اخبار</option>
                                <option value="noti">اطلاعیه</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor"> متن :</label>
                            <textarea class="form-control" id="editor" name="desc" >

                            </textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">

                        <div class="col-md-3">
                            <label for="hashtag"> تگ ها   :</label>
                            <input type="text" class="form-control" name="hashtag">
                        </div>

                        <div class="col-md-3">
                            <label for="level">رنک نمایش :</label>
                            <select name="level" class="form-control" id="">
                                <option value="2">عادی</option>
                                <option value="1">بی اهمیت</option>
                                <option value="3">بسیار مهم</option>
                            </select>

                        </div>
                        
                        <div class="col-md-3">
                            <label for="img"> عکس :</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>

                        
                    
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">افزودن  </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection