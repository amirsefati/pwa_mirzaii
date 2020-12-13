@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                گزارش 
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>کاربر </th>
                        <th>سلاح </th>
                        <th>ساعت </th>
                        <th>اعتبار قبلی </th>
                        <th>نوع عملیات </th>
                        <th>اعتبار بعدی </th>
                        <th>هزینه </th>
                        <th>اطلاعات </th>
                        <th>توسط </th>


                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($payment as $pay)
                        <tr>
                            <td>{{App\Models\User::find($pay->user_id)->name}} - {{App\Models\User::find($pay->user_id)->code_meli}}</td>
                            
                            <td>{{$pay->gun == 1 ? 'با اسلحه' : 'بدون اسلحه'}}</td>
                            <td>{{$pay->etc1}}</td>

                            <td>{{$pay->from}}</td>
                            <td>{{$pay->kind_operation}}</td>
                            <td>{{$pay->to}}</td>
                            <td>{{$pay->price}}</td>
                            <td>{{$pay->info}}</td>
                            <td>{{$pay->by}}</td>

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