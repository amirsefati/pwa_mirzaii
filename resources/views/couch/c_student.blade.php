@extends('couch.master')
@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                {{$user->name}}
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="name">نام کاربر : </label>
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" disabled>
                    </div>

                    <div class="col-md-6">
                        <label for="phone">شماره تلفن :</label>
                        <input type="text" class="form-control" name="phone"  value="{{$user->phone}}" disabled>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="code_meli">کد ملی :</label>
                        <input type="text" class="form-control" name="code_meli"  value="{{$user->code_meli}}" disabled>
                    </div>

                    <div class="col-md-3">
                        <label for="born"> تاریخ تولد :</label>
                        <input type="text" class="form-control" name="born"  value="{{$user->born}}" disabled>
                    </div>

                    <div class="col-md-3">
                        <label for="kind"> نوع کاربری  :</label>
                        <select name="kind" class="form-control" id="" disabled>
                            <option value="{{$user->kind}}">
                                @if($user->kind === '0')
                                    کاربر عادی
                                @elseif($user->kind === '1')
                                    دانشگاه غیر دانشگاه  تهرانی
                                @elseif($user->kind === '2')
                                    دانشگاه تهرانی
                                @elseif($user->kind === '3')
                                    استاد یا کارمند
                                @endif
                                (انتخاب کاربر)
                            </option>
                            <option value="0">گاربر عادی</option>
                            <option value="1">دانشجو غیر دانشگاه تهران</option>
                            <option value="2">دانشجو دانشگاه تهران</option>

                            <option value="3">استاد یا کارمند</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="email"> ایمیل :</label>
                        <input type="text" class="form-control" name="email"  value="{{$user->email}}" disabled>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="has_gun">دارای سلاح :</label>
                        <select name="has_gun" class="form-control" id="" disabled>
                            <option value="{{$user->has_gun}}">{{$user->has_gun ? 'اسلحه دارد' : 'اسلحه ندارد'}} (انتخاب کاربر)</option>
                            <option value="0">اسلحه ندارد</option>
                            <option value="1">اسلحه دارد</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="created_at">تاریخ عضویت :</label>
                        <input type="text" class="form-control" value="{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($user->created_at))}}" disabled>
                    </div>

                    
                </div>


            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                فایل های تمرین
            </div>
            <div class="card-body">
            <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 20%;">تاریخ</th>
                        <th style="width: 10%;">تگ</th>

                        <th style="width: 5%;">فایل تمرین</th>                      
                        <th style="width: 35%;">تحلیل مربی</th>
                        <th style="width: 25%;">فایل تحلیل</th>
                        <th style="width: 5%;">ارسال</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($exercise_list as $file)
                        @if(App\Models\Exercise_file_solve::where('exercise_files_id',$file->id)->count() < 1)
                        <tr>
                            <td>{{$file->time}}</td>
                            <td>{{$file->tag}}</td>
                            <td><a href="{{$file->file}}">دانلود</a></td>
                            <form action="/couch/add_solve_exercise" method="post">
                            @csrf
                            <input type="text" name="file_exercise" value="{{$file->id}}" hidden>
                            <input type="text" name="student_id" value="{{$user->id}}" hidden>

                            <td>
                                <input type="text" name="comment" class="form-control" required>
                            </td>
                            <td><input type="file" name="file" class="form-control"></td>
                            <td><button class="btn btn-success">ارسال</button></td>
                            </form>
                        </tr>
                        @endif

                    @endforeach
                   
                    </tbody>
                </table>
            </div>
        </div>
        </div>


        <div class="card">
            <div class="card-header">
                فایل های اسکت
            </div>
            <div class="card-body">
            <input class="form-control" id="myInput" type="text" placeholder="جست جو ...">
                <br>
                <div style="overflow-x: auto;">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th style="width: 20%;">تاریخ</th>
                        <th style="width: 5%;">فایل اسکت</th>                      
                        <th style="width: 45%;">تحلیل اسکت</th>
                        <th style="width: 5%;">ارسال</th>

                    </tr>
                    </thead>
                    <tbody id="myTable">

                    @foreach($skat_list as $file)
                        @if(App\Models\Exercise_file_solve::where('exercise_files_id',$file->id)->count() < 1)
                        <tr>
                            <td>{{$file->time}}</td>
                            <td><a href="{{$file->file}}">دانلود</a></td>
                            <form action="/couch/add_solve_skat" method="post">
                            @csrf
                            <input type="text" name="skat_id" value="{{$file->id}}" hidden>

                            <td>
                                <input type="text" name="comment" class="form-control" value="{{$file->comment}}" required>
                            </td>
                            <td><button class="btn btn-warning">آپدیت</button></td>
                            </form>
                        </tr>
                        @endif

                    @endforeach
                   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection