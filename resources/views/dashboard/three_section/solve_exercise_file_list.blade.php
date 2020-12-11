@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                تحلیل تمرین کاربر ( {{App\Models\User::where('id',$id)->first()->name}} )
            </div>

            <div class="card-body">
                <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th> تاریخ ارسال </th>
                        <th> تگ </th>                        
                        <th> فایل</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @if(strlen($list) >20)

                        @foreach($list as $l)
                            <tr>
                                <td><a href="/manager/solve_exercise_file_list_item/{{$l->id}}">{{$l->time}}</a></td>
                                <td>{{$l->tag}}</td>
                                <td><a href="{{$l->file}}">فایل</a></td>

                            </tr>
                        
                        @endforeach

                    @else

                    <tr>
                        <td colspan="3" style="text-align: center">
                        <a href="/manager/solve_exercise_file">هیچ تمرینی بارگذاری نشده است</a>
                        
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