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
                        <th>عنوان دوره</th>
                        <th>مربی</th>
                        <th>نوع دوره</th>
                        <th> تعداد ساعت</th>
                        <th>مبلغ</th>
                        <th>مهلت ثبت نام</th>
                        <th>تاریخ شروع دوره</th>
                        <th>ظرفیت</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($course_list as $course)
                        <tr>

                            <td><img src="{{$course->img}}" style="width:40px" alt=""></td>

                            <td>{{$course->title}}</td>
                            <td>{{$course->author}}</td>
                            <td>{{$course->etc}}</td> <!-- نوع دوره -->
                            <td>{{$course->count_hourse}}</td>
                            <td>{{$course->price}}</td>
                            <td>{{$course->deadline}}</td>
                            <td>{{$course->starting}}</td>

                            <td>
                                <a href="/manager/course/edit_course/{{$course->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/course/delete_course/{{$course->id}}">
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