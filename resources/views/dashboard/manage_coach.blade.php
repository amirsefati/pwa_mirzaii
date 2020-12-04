@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                مدیریت مربی ها 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> مربی </th>
                        <th> نام</th>
                        <th>درجه مربی گری</th>
                        <th> تگ و اسلحه</th>
                        <th> رشته تخصصی</th>
                        <th> عملیات</th>


                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($coach_list as $coach)
                        <tr>

                            <td><img src="{{$coach->img}}" style="width:40px" alt=""></td>

                            <td>{{$coach->name}}</td>

                            <td>
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

                            </td>

                            <td>{{$coach->hashtag}}</td>
                            <td>{{$coach->guns}}</td>

                            <td>
                                <a href="/manager/coach/edit_coach/{{$coach->id}}">
                                    <img src="/dashboard/img/edit.png" width="25px" alt="">
                                </a>
                                <span style="padding: 4px;"></span>
                                <a href="/manager/coach/delete_coach/{{$coach->id}}">
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