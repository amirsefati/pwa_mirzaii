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
            <div class="card-header">افزودن مربی و ساعت حضور     </div>
            <div class="card-body">
                <form action="/manager/add_coach_post" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">نام و نام خانوادگی  :</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label for="kind"> درجه مربی گری :</label>
                            <select name="kind" class="form-control" id="">
                                <option value="1">3</option>
                                <option value="2">2</option>
                                <option value="3">1</option>
                                <option value="4">بین المللی/آسیایی D</option>
                                <option value="5">بین المللی/آسیایی C</option>
                                <option value="6">بین المللی/آسیایی B</option>
                                <option value="7">بین المللی/آسیایی A</option>

                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label for="editor"> توضیحات و زمان بندی :</label>
                            <textarea class="form-control" id="editor" name="desc" >
                            <p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><figure class="table"><table><thead><tr><th>تاریخ</th><th>ساعت حضور در باشگاه</th></tr></thead><tbody><tr><th>شنبه</th><td>8 الی 12 - 14 الی 16</td></tr><tr><th>یکشنبه</th><td>&nbsp;</td></tr><tr><th>دوشنبه</th><td>&nbsp;</td></tr><tr><th>سه شنبه</th><td>&nbsp;</td></tr><tr><th>چهارشنبه</th><td>&nbsp;</td></tr><tr><th>پنج شنبه</th><td>&nbsp;</td></tr><tr><th>جمعه</th><td>&nbsp;</td></tr></tbody></table></figure><p>&nbsp;</p>
                            </textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">

                        <div class="col-md-3">
                            <label for="hashtag"> تگ ها و اسلحه :</label>
                            <input type="text" class="form-control" name="hashtag">
                        </div>

                        <div class="col-md-3">
                            <label for="rank_show">رنک نمایش :</label>
                            <select name="rank_show" class="form-control" id="">
                                <option value="2">عادی</option>
                                <option value="1">انتهایی</option>
                                <option value="3">بالاترین</option>
                            </select>

                        </div>

                        <div class="col-md-3">
                            <label for="guns"> رشته تخصصی :</label>
                            <input type="text" class="form-control" name="guns">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="img"> عکس مربی :</label>
                            <input type="file" class="form-control" name="img" required>
                        </div>

                        
                    
                    </div>

                    <br/>
                    <hr/>

                    <div class="row mt-5 mb-3">
                        <div class="col-md-12" style="text-align: center;">
                            <button class="btn btn-success pl-5 pr-5 ">افزودن مربی </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection