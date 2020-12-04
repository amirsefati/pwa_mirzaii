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
            <div class="card-header">افزودن مسابقه     </div>
            <div class="card-body">
                <form action="/manager/add_competition_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="title">عنوان مسابقه :</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="timer"> تاریخ مسابقه :</label>
                            <input type="text" name="timer" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor">متن مسابقه :</label>
                            <textarea class="form-control" id="editor" name="desc"></textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <label for="qunitity">تعداد  :</label>
                            <input type="text" class="form-control" name="quantity">
                        </div>

                        <div class="col-md-3">
                            <label for="price">مبلغ :</label>
                            <input type="text" class="form-control" name="price">
                        </div>

                        <div class="col-md-3">
                            <label for="award">جوایز :</label>
                            <input type="text" class="form-control" name="award">
                        </div>

                        <div class="col-md-3">
                            <label for="conditions">شرایط ثبت نام :</label>
                            <input type="text" class="form-control" name="conditions">
                        </div>
                    
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="link_signup"> لینک ثبت نام :</label>
                            <input type="text" class="form-control" name="starting">
                        </div>  
                        
                        <div class="col-md-3">
                            <label for="etc"> نوع اطلاعیه :</label>
                            <select name="etc" class="form-control" id="">
                                <option value="مسابقات">مسابقات</option>
                                <option value="نتایج">نتایج</option>
                            </select>
                        </div> 

                        <div class="col-md-3">
                            <label for="img">کاور مسابقه :</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">ارسال مسابقه</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection