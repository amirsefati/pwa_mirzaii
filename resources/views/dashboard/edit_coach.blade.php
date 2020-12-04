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
            <div class="card-header">ویرایش مربی و ساعت حضور     </div>
            <div class="card-body">
                <form action="/manager/edit_coach_post" method="POST" enctype="multipart/form-data">
                    <input type="text" name="id" value="{{$coach->id}}" hidden>
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">نام و نام خانوادگی  :</label>
                            <input type="text" name="name" class="form-control" required value="{{$coach->name}}">
                        </div>

                        <div class="col-md-6">
                            <label for="kind"> درجه مربی گری : (
                                @switch($coach->kind)
                                    @case(1)
                                        درجه 3
                                    @break

                                    @case(2)
                                        درجه 2
                                    @break

                                    @case(3)
                                        درجه 1
                                    @break

                                    @case(4)
                                        بین المللی/آسیایی D
                                    @break

                                    @case(5)
                                        بین المللی/آسیایی C
                                    @break

                                    @case(6)
                                        بین المللی/آسیایی B
                                    @break

                                    @case(7)
                                        بین المللی/آسیایی A
                                    @break                                    
                                @endswitch
                                )
                            </label>
                            <select name="kind" class="form-control" id="" required>
                                <option value="{{$coach->kind}}">...</option>
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
                            {{$coach->desc}}
                            </textarea>
                        </div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row mt-4">

                        <div class="col-md-3">
                            <label for="hashtag"> تگ ها و اسلحه :</label>
                            <input type="text" class="form-control" name="hashtag" value="{{$coach->hashtag}}">
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
                            <input type="text" class="form-control" name="guns" value="{{$coach->guns}}">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="img"> عکس مربی :
                                (کاور :
                                <img src="{{$coach->img}}" width="30px" alt="">
                                )
                            </label>
                            <input type="file" class="form-control" name="img" required>
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