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
                            @if($data->kind_operation == null)
                            <td>واریزی <span style="color:green">{{($data->status == 1) ? 'موفق' : ''}}</span> <span style="color: red;font-size:9px">{{($data->status == 1) ? '' : 'لغو'}}</span></td>
                            <td style="font-size: 9px;">مبلغ : {{$data->price/10}} تومان | کد درگاه : {{$data->res_code}} | کد پرداخت : {{$data->saleReferenceId}} | ای پی : {{$data->ip}} | کد وضعیت : {{$data->etc1}} | تعداد جلسه : {{$data->etc2}}</td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($data->created_at))}}</td>

                            @else
                            <td>عملیات <span style="color:#849324;font-size: 13px">{{$data->kind_operation == 'رزرو' ? 'رزرو' : ''}}</span>  <span style="color:#FFB30F;font-size: 9px">{{$data->kind_operation == 'رزرو' ? '' : 'لغو'}}</span></td>
                            <td style="font-size: 9px;">
                                تاریخ رزرو : {{$data->etc1}} | مالیت اسلحه {{$data->gun}} | از {{$data->from}} به {{$data->to}}
                            </td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($data->created_at))}}</td>

                            @endif

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