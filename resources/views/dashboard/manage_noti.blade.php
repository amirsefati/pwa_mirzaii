@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                مدیریت اخبار و اطلاعیه ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> عکس </th>
                        <th> نوع </th>
                        <th> عنوان</th>
                        <th> هشتگ  </th>
                        <th> نمایش</th>
                        <th> عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($noti_list as $noti)
                        <tr>

                            <td><img src="{{$noti->img}}" style="width:40px" alt=""></td>

                            <td>{{$noti->link}}</td>

                          
                            <td>{{$noti->title}}</td>
                            <td>{{$noti->hashtag}}</td>
                            <td>{{$noti->level}}</td>

                            <td>
                                <a href="/manager/noti/edit_noti/{{$noti->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/noti/delete_noti/{{$noti->id}}">
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