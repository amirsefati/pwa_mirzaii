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
                        <th>نوع کاربری </th>
                        <th>کد درگاه </th>
                        <th>قیمت </th>
                        <th>وضعیت </th>
                        <th>کد پرداخت </th>
                        <th>ای پی </th>
                        <th>کد وضعیت </th>
                        <th>تعداد جلسه </th>
                        <th>تاریخ </th>


                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($payment as $pay)
                        <tr>
                            <td>{{App\Models\User::find($pay->user_id)->name}} 
                                @if($pay->user_id == '2') <!--  یعنی مدیر بود-->
                                   <span style="font-size: 9px;color:red">رزرو برای </span> <span style="font-size:7px">{{(App\Models\Report::where('etc2',$pay->id)->first()) ? (App\Models\Report::where('etc2',$pay->id)->first()->info) : ''}}</span>
                                @endif
                            </td>
                            <td>
                            @if($pay->user_id == '2') <!--  یعنی مدیر بود-->
                                <div style="display: none;">
                                {{(App\Models\Report::where('etc2',$pay->id)->first()) ? ($etc3_t = App\Models\Report::where('etc2',$pay->id)->first()->etc3) : $etc3_t = '' }}
                                </div>
                                @if($etc3_t == 0)
                                    <p>دانشجوی دانشکده فنی</p>
                                @elseif($etc3_t == 1)
                                    <p>دانشجوی غیر دانشکده فنی</p>
                                @elseif($etc3_t == 2)
                                    <p>اساتید و کارکنان دانشکده فنی</p>

                                @elseif($etc3_t == 3)
                                    <p> اساتید و کارکنان غیر دانشکده فنی </p>
                                
                                @elseif($etc3_t == 4)
                                    <p>عادی</p>

                                @endif
                            @else
                                <div style="display: none;">
                                {{$user = App\Models\User::find($pay->user_id)->first()}}
                                </div>
                            @if($user->kind == 0)
                                    <p>دانشجوی دانشکده فنی</p>
                                @elseif($user->kind == 1)
                                    <p>دانشجوی غیر دانشکده فنی</p>
                                @elseif($user->kind == 2)
                                    <p>اساتید و کارکنان دانشکده فنی</p>

                                @elseif($user->kind == 3)
                                    <p> اساتید و کارکنان غیر دانشکده فنی </p>
                                
                                @elseif($user->kind == 4)
                                    <p>عادی</p>

                                @endif
                            @endif
                
                            </td>
                            <td>{{$pay->res_code}}</td>

                            <td>{{$pay->price}}</td>
                            <td>{{($pay->status == 1) ? 'موفق' : 'لغو'}}</td>
                            <td>{{$pay->saleReferenceId}}</td>
                            <td>{{$pay->ip}}</td>
                            <td>{{$pay->etc1}}</td>
                            <td>{{$pay->etc2}}</td>
                            <td style="font-size:9px">{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($pay->created_at))}}</td>

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