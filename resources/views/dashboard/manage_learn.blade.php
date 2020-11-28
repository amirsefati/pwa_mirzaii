@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                مدیریت آموزش ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>کاور </th>
                        <th>عنوان آموزش</th>
                        <th>تولید کننده</th>
                        <th>دسته بندی</th>
                        <th>هشتگ</th>
                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($news_list as $news)
                        <tr>

                            <td><img src="{{$news->img}}" style="width:40px" alt=""></td>

                            <td>{{$news->title}}</td>

                            <td>{{$news->author}}</td>
                            <td>{{$news->cate}}</td>
                            <td>{{$news->hashtag}}</td>
                            <td>
                                <a href="/manager/news/edit_news/{{$news->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/news/delete_news/{{$news->id}}">
                                    <img src="/dashboard/img/delete.png" width="25px" alt="">
                                </a>
                            </td>

                        </tr>

                    @endforeach
                   
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection