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
            <div class="card-header">ویرایش مسابقه     </div>
            <div class="card-body">
                <form action="/manager/edit_competition_post" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id" value="{{$competition->id}}" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان مسابقه :</label>
                            <input type="text" name="title" class="form-control" required value="{{$competition->title}}">
                        </div>

                        <div class="col-md-6">
                            <label for="timer"> تاریخ مسابقه :</label>
                            <input type="text" name="timer" class="form-control" required value="{{$competition->timer}}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor">متن مسابقه :</label>
                            <textarea class="form-control" id="editor" name="desc">{{$competition->desc}}</textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="qunitity">تعداد  :</label>
                            <input type="text" class="form-control" name="quantity" value="{{$competition->quantity}}">
                        </div>

                        <div class="col-md-3">
                            <label for="price">مبلغ :</label>
                            <input type="text" class="form-control" name="price" value="{{$competition->price}}">
                        </div>

                        <div class="col-md-3">
                            <label for="award">جوایز :</label>
                            <input type="text" class="form-control" name="award" value="{{$competition->award}}">
                        </div>

                        <div class="col-md-3">
                            <label for="conditions">شرایط ثبت نام :</label>
                            <input type="text" class="form-control" name="conditions"  value="{{$competition->conditions}}">
                        </div>
                    
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="link_signup"> لینک ثبت نام :</label>
                            <input type="text" class="form-control" name="starting"  value="{{$competition->starting}}">
                        </div>  
                        
                        <div class="col-md-3">
                            <label for="etc"> نوع اطلاعیه ({{$competition->etc}}):</label>
                            <select name="etc" class="form-control" id="">
                                <option value="مسابقات">مسابقات</option>
                                <option value="نتایج">نتایج</option>
                            </select>
                        </div> 

                        <div class="col-md-3">
                            <label for="img">کاور مسابقه :
                                (کاور :
                                <img src="{{$competition->img}}" width="30px" alt="">
                                )
                            </label>
                            <input type="file" class="form-control" name="img" required>
                        </div>
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-warning pl-5 pr-5 ">ویرایش مسابقه</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection