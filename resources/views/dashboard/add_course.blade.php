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
            <div class="card-header">افزودن دوره     </div>
            <div class="card-body">
                <form action="/manager/add_course_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان دوره :</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="author"> مربی :</label>
                            <input type="text" name="author" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor">متن دوره :</label>
                            <textarea class="form-control" id="editor" name="desc"></textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="count_hourse">تعداد ساعت :</label>
                            <input type="text" class="form-control" name="count_hourse">
                        </div>

                        <div class="col-md-3">
                            <label for="price">مبلغ :</label>
                            <input type="text" class="form-control" name="price">
                        </div>

                        <div class="col-md-3">
                            <label for="deadline">مهلت ثبت نام :</label>
                            <input type="text" class="form-control" name="deadline">
                        </div>

                        <div class="col-md-3">
                            <label for="documents">مدارک مورد نیاز :</label>
                            <input type="text" class="form-control" name="documents">
                        </div>
                    
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="starting"> تاریخ شروع دوره :</label>
                            <input type="text" class="form-control" name="starting">
                        </div>

                        <div class="col-md-3">
                            <label for="quantity"> ظرفیت :</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>

                        <div class="col-md-3">
                            <label for="quantity"> نوع دوره :</label>
                            <select name="etc" class="form-control" id="">
                                <option value="مربی گری">مربی گری</option>
                                <option value="داوری">داوری</option>
                                <option value="کارگاه ها">کارگاه ها</option>

                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="img">کاور آموزش :</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>
                    </div>
                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">ارسال دوره</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection