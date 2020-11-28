@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                مدیریت گالری ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>عنوان گالری </th>
                        <th> شرح گالری</th>
                        <th>تاریخ گالری</th>
                        <th>نوع گالری</th>
                        <th>کاور گالری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($gallery_list as $gallery)
                        <tr>


                            <td>{{$gallery->title}}</td>
                            <td>{{$gallery->desc}}</td>
                            <td>{{$gallery->times}}</td>
                            <td>{{$gallery->kind}}</td>
                            <td>
                            <img src="{{$gallery->img}}" width="25px" alt="">
 
                            </td>

                            <td>
                                <a href="/manager/gallery/edit_gallery/{{$gallery->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/gallery/delete_gallery/{{$gallery->id}}">
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