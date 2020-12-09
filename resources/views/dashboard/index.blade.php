@extends('dashboard.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                لیست رزرو ها    
            </div>

            <div class="card-body">
                <div class="row mt-4 mb-4">
                    <div class="col-md-12" style="text-align:center">
                        <p style="font-size: 18px;font-weight: bold;"> تاریخ اطلاعات : {{$data->d_j}}</p>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                        <th scope="col" style="border:.4px solid gray"> 8 - 9:30</th>
                        <th scope="col" style="border:.4px solid gray"> 9:30 - 11</th>
                        <th scope="col" style="border:.4px solid gray"> 11 - 12:30</th>
                        <th scope="col" style="border:.4px solid gray"> 12:30 - 14</th>
                        <th scope="col" style="border:.4px solid gray"> 14 - 15:30</th>
                        <th scope="col" style="border:.4px solid gray"> 15:30 - 17</th>
                        <th scope="col" style="border:.4px solid gray"> 17 - 18:30</th>
                        <th scope="col" style="border:.4px solid gray"> 18:30 - 20</th>
                        <th scope="col" style="border:.4px solid gray"> 20 : 21:30</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @foreach(json_decode($data->data) as $d1)
                            <td style="border:.4px solid gray">
                                @foreach($d1 as $d)
                                    <li style="font-size:10px;">{{App\Models\User::where('id',$d)->first()->name}}</li>
                                @endforeach
                            </td>
                        @endforeach
                      
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection