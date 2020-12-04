@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                مدیریت مسابقه ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>کاور </th>
                        <th>عنوان </th>

                        <th> تاریخ مسابقه</th>
                        <th> تعداد</th>
                        <th> مبلغ</th>
                        <th> جوایز</th>
                        <th> عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($competition_list as $competition)
                        <tr>

                            <td><img src="{{$competition->img}}" style="width:40px" alt=""></td>

                            <td>{{$competition->title}}</td>
                            <td>{{$competition->timer}}</td>
                            <td>{{$competition->quantity}}</td>
                            <td>{{$competition->price}}</td>
                            <td>{{$competition->award}}</td>

                            <td>
                                <a href="/manager/competition/edit_competition/{{$competition->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/competition/delete_competition/{{$competition->id}}">
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