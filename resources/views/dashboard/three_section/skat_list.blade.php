@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تحلیل اسکت های کاربر ( {{App\Models\User::where('id',$id)->first()->name}} )
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> تاریخ ارسال </th>
                        <th> فایل</th>
                        <th> عملیات</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @if(strlen($list) >20)

                        @foreach($list as $l)
                            <tr>
                                <td>{{$l->time}}</td>
                                <td><a href="{{$l->file}}">فایل</a></td>
                                <td><a href="/manager/dl_skat/{{$l->id}}">حذف</a></td>
                            </tr>
                        
                        @endforeach

                    @else

                    <tr>
                        <td colspan="4" style="text-align: center">
                        <a href="/manager/add_skat/{{$id}}">هیچ اسکت بارگذاری نشده است</a>
                        
                        </td>
                    </tr>

                    @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection