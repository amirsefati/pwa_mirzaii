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
            <div class="card-header">ویرایش اخبار و اطلاعیه ها      </div>
            <div class="card-body">
                <form action="/manager/edit_noti_post" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id" value="{{$noti->id}}" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name"> عنوان  :</label>
                            <input type="text" name="title" class="form-control" required value="{{$noti->title}}">
                        </div>

                        <div class="col-md-6">
                            <label for="link"> موضوع :</label>
                            <select name="link" class="form-control" id="">
                                <option value="{{$noti->link}}" selected>{{$noti->link}}</option>

                                <option value="news">اخبار</option>
                                <option value="noti">اطلاعیه</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor"> توضیحات :</label>
                            <textarea class="form-control" id="editor" name="desc" >
                            {{$noti->desc}}
                            </textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">

                        <div class="col-md-3">
                            <label for="hashtag"> تگ ها  :</label>
                            <input type="text" class="form-control" name="hashtag" value="{{$noti->hashtag}}">
                        </div>

                        <div class="col-md-3">
                            <label for="level">رنک نمایش :</label>
                            <select name="level" class="form-control" id="">
                                <option value="{{$noti->level}}">{{$noti->level}}</option>
                                <option value="2">عادی</option>
                                <option value="1">انتهایی</option>
                                <option value="3">بالاترین</option>
                            </select>

                        </div>

                       
                        
                        <div class="col-md-3">
                            <label for="img"> عکس مربی :
                                (کاور :
                                <img src="{{$noti->img}}" width="30px" alt="">
                                )
                            </label>
                            <input type="file" class="form-control" name="img">
                        </div>

                        
                    
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-warning pl-5 pr-5 ">  ویرایش </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection