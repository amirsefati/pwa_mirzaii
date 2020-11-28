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
            <div class="card-header">ویرایش گالری     </div>
            <div class="card-body">
                <form action="/manager/edit_gallery_post" method="POST" enctype="multipart/form-data">
                <input type="text" name="id" value="{{$gallery->id}}" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان گالری :</label>
                            <input type="text" name="title" class="form-control" required value="{{$gallery->title}}">
                        </div>

                        <div class="col-md-6">
                            <label for="desc"> شرح مختصر :</label>
                            <input type="text" name="desc" class="form-control" value="{{$gallery->desc}}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="desc2">توضیح کامل گالری :</label>
                            <textarea class="form-control" id="editor" name="desc2">{{$gallery->desc2}}</textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="times"> تاریخ گالری :</label>
                            <input type="text" class="form-control" name="times" value="{{$gallery->times}}">
                        </div>

                        <div class="col-md-3">
                            <label for="kind"> نوع دوره :</label>
                            <input type="text" class="form-control" name="kind" value="{{$gallery->kind}}">
                        </div>

                        <div class="col-md-3">
                            <label for="hashtag"> تگ دوره :</label>
                            <input type="text" class="form-control" name="hashtag" value="{{$gallery->hashtag}}">
                        </div>

                        <div class="col-md-3">
                            <label for="img">کاور گالری :
                                (کاور :
                                <img src="{{$gallery->img}}" width="30px" alt="">
                                )
                            </label>
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

                   <div class="row mt-3">
                       @foreach(json_decode($gallery->images) as $item)
                            <div class="col-md-2">
                                <img src="{{$item}}" width="100%" alt="">
                            </div>
                       @endforeach
                   </div>

                   <br/>
                   <br/>
                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-warning pl-5 pr-5 ">ویرایش گالری</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection