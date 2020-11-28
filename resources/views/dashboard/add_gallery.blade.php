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
            <div class="card-header">افزودن گالری     </div>
            <div class="card-body">
                <form action="/manager/add_gallery_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان گالری :</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="desc"> شرح مختصر :</label>
                            <input type="text" name="desc" class="form-control">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="desc2">توضیح کامل گالری :</label>
                            <textarea class="form-control" id="editor" name="desc2"></textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="times"> تاریخ گالری :</label>
                            <input type="text" class="form-control" name="times">
                        </div>

                        <div class="col-md-3">
                            <label for="kind"> نوع دوره :</label>
                            <input type="text" class="form-control" name="kind">
                        </div>

                        <div class="col-md-3">
                            <label for="hashtag"> تگ دوره :</label>
                            <input type="text" class="form-control" name="hashtag">
                        </div>

                        <div class="col-md-3">
                            <label for="img">کاور گالری :</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>
                    
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="img">عکس های گالری :</label>
                            <input type="file" class="form-control" name="images[]" multiple required>
                        </div>
                    </div>

                   
                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">ارسال گالری</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection