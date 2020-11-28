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
            <div class="card-header">افزودن آموزش </div>
            <div class="card-body">
                <form action="/manager/add_learn_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان آموزش :</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="author">تولید کننده :</label>
                            <input type="text" name="author" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor">متن آموزش :</label>
                            <textarea class="form-control" id="editor" name="desc"></textarea>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="cate"> دسته بندی :</label>
                            <select name="cate"  class="form-control" id="">
                                <option value="تغذیه">تغذیه</option>
                                <option value="آموزش های تخصصی تیراندازی">آموزش های تخصصی تیراندازی</option>
                                <option value="حرکات اصلاحی و آسیب شناسی">حرکات اصلاحی و آسیب شناسی</option>
                                <option value="روان شناسی ورزشی">روان شناسی ورزشی</option>
                                <option value="نکات عمومی">نکات عمومی</option>

                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="hastag">هشتگ ها :</label>
                            <input type="text" name="hashtag" class="form-control" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="img">کاور آموزش</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>

                    </div>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">ارسال آموزش</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection