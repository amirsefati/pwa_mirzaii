@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                کاربران تایید نشده   
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>نام کاربر </th>
                        <th>کدملی</th>
                        <th>شماره تلفن</th>

                        <th>عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($users as $user)
                        <tr>

                            <td>{{$user->name}}</td>
                            <td>{{$user->code_meli}}</td>
                            <td>{{$user->phone}}</td>


                            <td>
                                <form action="/manager/add_credit_touser" method="POST">
                                    @csrf
                                    <input type="text" name="id" value="{{$user->id}}" hidden>
                                    <div class="row" style="min-width: 500px;">
                                        <div class="col-md-5 col-5">
                                            <label for="has_gun">با سلاح :</label>
                                            <input type="number" name="has_gun" class="form-control" value="{{$user->creadit_has_gun}}">
                                        </div>

                                        <div class="col-md-5 col-5">
                                            <label for="has_gun">بدون سلاح :</label>
                                            <input type="number" name="no_gun" class="form-control" value="{{$user->creadit_no_gun}}">
                                        </div>

                                        <div class="col-md-2 col-2 mt-4">
                                            <button class="btn btn-warning mt-1">آپدیت</button>
                                        </div>
                                    </div>
                                </form>

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