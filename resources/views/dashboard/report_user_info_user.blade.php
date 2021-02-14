@extends('dashboard.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">گزارش کاربر ( {{$user->name}} )</div>
            <div class="card-body">
            <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> نوع عملیات </th>
                        <th> شرح عملیات  </th>
                        <th> تاریخ </th>


                    </tr>
                    </thead>
                    <tbody id="myTable">
                    <div style="display: none;">
                    {{$all = $payment->merge($report)}}
                    {{$all = $all->sortByDesc('created_at')}}
                    </div>
                        @foreach($all as $data)
                        <tr>
                            <td>{{($data->kind_operation == null ? 'واریز' : 'رزرو')}}</td>
                            <td> {{$data->kind_operation}} / {{$data->etc1}} / <span style="color:cornflowerblue">{{($data->price > 10000) ? ($data->price/10000 . ' هزار تومان - ' . ' رسید خرید  '  . $data->saleReferenceId ) : ''}}</span></td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($data->created_at))}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection()