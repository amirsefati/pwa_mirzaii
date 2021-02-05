<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Noti;
use App\Models\Skat;
use App\Models\User;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Report;
use App\Models\Gallery;
use App\Models\Payment;
use App\Models\Reserve;
use App\Models\Competition;
use App\Models\Configsysyem;
use Illuminate\Http\Request;
use App\Models\Exercise_file;
use App\Models\Exercise_file_solve;
use App\Models\Offcode;
use App\Models\Offreport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Client extends Controller
{
    public function getlearn(){
        $learn = News::all();
        return $learn;   
    }

    public function getcourse(){
        $course = Course::all();
        return $course;
    }

    public function getgallery(){
        $gallery = Gallery::all();
        return $gallery; 
    }

    public function getcompetition(){
        $competition = Competition::all();
        return $competition; 
    }

    public function getcoach(){
        $coach = Coach::all();
        return $coach; 
    }


    public function checklogin(){
        if(Auth::check()){
            $user = Auth::user();
            return ['status' => '200', 'user' => $user];
        }else{
            return ['status' => '301'];
        }
    }

    public function register_attempt(Request $request){
        $name = $request->data['name'];
        $email = $request->data['email'];
        $password = $request->data['password'];
        $born = $request->data['born'];
        $tel = $request->data['tel'];
        $code_meli = $request->data['code_meli'];

        if(strlen($name) < 5){
            return ['status'=>'300','err'=>'لطفا نام خود را کامل وارد کنید'];
        }elseif(strlen($email) < 6){
            return ['status'=>'300','err'=>'لطفا ایمیل خود را کامل وارد کنید'];
        }elseif(strlen($password) < 6){
            return ['status'=>'300','err'=>'لطفا پسورد خود را کامل وارد کنید'];
        }elseif(strlen($tel) < 9){
            return ['status'=>'300','err'=>'لطفا تلفن خود را کامل وارد کنید'];
        }elseif(strlen($code_meli) < 9){
            return ['status'=>'300','err'=>'لطفا کد ملی خود را کامل وارد کنید'];
        }elseif(User::where('email',$email)->count() > 0){
            return ['status'=>'300','err'=>'چنین ایمیلی قبلا در سامانه ثبت شده است'];
        }elseif(User::where('phone',$tel)->count() > 0){
            return ['status'=>'300','err'=>'چنین شماره تلفنی قبلا در سامانه ثبت شده است'];
        }elseif(User::where('code_meli',$code_meli)->count() > 0){
            return ['status'=>'300','err'=>'چنین کدملی قبلا در سامانه ثبت شده است'];
        }
        else{
            $user = User::create([
                'name' => $name,
                'password' => $password,
                'phone' => $tel,
                'code_meli' => $code_meli,
                'email' => $email,
                'born' => $born,
            ]);
            Auth::loginUsingId($user->id,true);
            return ['status'=>'200'];
        }
        return ['status'=> '400'];
    }


    public function upload_img_v(Request $request){

        $request->validate([
            'name' => 'required',
            'code_meli' => 'required',
            'has_gun' => 'required',
            'phone' => 'required',
            'email' => 'required',

            'fl1' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
            'fl2' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
            'fl3' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',

        ]);

        if(User::where('code_meli',$request->code_meli)->count() > 1){
            return ['status' => '300'];
        }elseif(User::where('phone',$request->phone)->count() > 1){
            return ['status' => '300'];
        }else{
            if($request->hasFile('fl1')){
                $image = $request->file('fl1');
                $name = Auth::user()->id . '-1-'. time() .'_' . rand(500,99999) . '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/documents/');
                $image->move($destinationPath, $name);
                $img_url1 = '/documents/' . $name ;
            }
    
            if($request->hasFile('fl2')){
                $image = $request->file('fl2');
                $name = Auth::user()->id . '-2-'. time() .'_' . rand(500,99999) . '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/documents/');
                $image->move($destinationPath, $name);
                $img_url2 = '/documents/' . $name ;
            }
    
            if($request->hasFile('fl3')){
                $image = $request->file('fl3');
                $name = Auth::user()->id . '-3-'. time() .'_' . rand(500,99999) . '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/documents/');
                $image->move($destinationPath, $name);
                $img_url3 = '/documents/' . $name ;
            }
            $img_url4 = '';
            if($request->hasFile('fl4')){
                $image = $request->file('fl4');
                $name = Auth::user()->id . '-4-'. time() .'_' . rand(500,99999) . '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/documents/');
                $image->move($destinationPath, $name);
                $img_url4 = '/documents/' . $name ;
            }

            $img_url5 = '';
            if($request->hasFile('fl5')){
                $image = $request->file('fl5');
                $name = Auth::user()->id . '-5-'. time() .'_' . rand(500,99999) . '.' .$image->getClientOriginalExtension();
                $destinationPath = public_path('/documents/');
                $image->move($destinationPath, $name);
                $img_url5 = '/documents/' . $name ;
            }
            
            if(strlen($img_url4) > 10){
                User::where('id',$request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'code_meli' => $request->code_meli,
                    'has_gun' => $request->has_gun,
                    'scan_shenasname' => $img_url1,
                    'scan_pic' => $img_url2,
                    'scan_bime' => $img_url3,
                    'etc2' => $img_url4,
    
                    'status' => '2',
                    'kind' => $request->kind
    
                ]);
            }else{
                User::where('id',$request->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'code_meli' => $request->code_meli,
                    'has_gun' => $request->has_gun,
                    'scan_shenasname' => $img_url1,
                    'scan_pic' => $img_url2,
                    'scan_bime' => $img_url3,
                    'etc2' => $img_url5,
    
                    'status' => '2',
                    'kind' => $request->kind
    
                ]);
            }
            
        }

        return ['status' => '200'];
    }

    public function getreserve_date(){
        $now = Carbon::now()->addDays(1,'day')->format('Y-m-d');
        $next= Carbon::now()->addDays(16,'day')->format('Y-m-d');
        $data = Reserve::whereBetween('d_m',[$now,$next])->get();
        $user = Auth::user();
        return ['status' => '200' , 'data' => $data , 'user' => $user];
    }

    public function reserv(Request $request){
        $day =  json_decode(Reserve::where('d_j',$request->data['whdate'])->first()->data);
        $id = Auth::user()->id;
        $gun = Auth::user()->has_gun;
        $w = intval($request->data['withgun']);
        $n = intval($request->data['nogun']);
        $kind_operation = ' ';
        foreach($day as $d => $k){
            if($d == $request->data['time']){
                if(!$request->data['status']){
                    array_push($day->$d,$id);
                    if($gun == '1'){
                        User::where('id',$id)->decrement('creadit_has_gun');
                        $w--;
                    }else{
                        User::where('id',$id)->decrement('creadit_no_gun');  
                        $n--;  
                    }
                    $kind_operation = 'رزرو';
                }else{
                    $idl = array_search($id,$day->$d);
                    unset($day->$d[$idl]);
                    if($gun == '1'){
                        User::where('id',$id)->increment('creadit_has_gun');
                        $w++;
                    }else{
                        User::where('id',$id)->increment('creadit_no_gun');
                        $n++;    
                    }
                    $kind_operation = 'لغو';
                }
            }
        }
        
        Reserve::where('d_j',$request->data['whdate'])->update([
            'data' => json_encode($day)
        ]);
        switch($request->data['time']){
            case 1:
                $time = '8-9:30';
                break;
            case 2:
                $time = '9:30-11';
                break;
            case 3:
                $time = '11-12:30';
                break;
            case 4:
                $time = '12:30-14';
                break;
            case 5:
                $time = '14-15:30';
                break;
            case 6:
                $time = '15:30-17';
                break;
            case 7:
                $time = '17-18:30';
                break;
            case 8:
                $time = '18:30-20';
                break;
            case 9:
                $time = '20-21:30';
                break;
        }
        Report::create([
            'user_id' => $id,
            'kind_operation' => $kind_operation,
            'from' =>  'w:(' .$request->data['withgun'] .') n: (' . $request->data['nogun'].')',
            'to' => 'w:(' .$w .') n: (' . $n.')',
            'gun' => Auth::user()->has_gun,
            'by' => 'کاربر',
            'etc1' => $request->data['whdate'] .' -> ساعت ('. $time . ')',

        ]);

        $now = Carbon::now()->addDays(1,'day')->format('Y-m-d');
        $next= Carbon::now()->addDays(16,'day')->format('Y-m-d');
        $data = Reserve::whereBetween('d_m',[$now,$next])->get();
        
        
        return ['status' => '200' , 'data' => $data , 'user' => User::where('id',$id)->first()];
    }

    public function login(Request $request){
        $code_meli = $request->data['code_meli'];
        $password = $request->data['password'];

        if(User::where('code_meli',$code_meli)->count() > 0){
            if(User::where('password',$password)->where('code_meli',$code_meli)->count() > 0){
                $user = User::where('password',$password)->where('code_meli',$code_meli)->first();
                Auth::loginUsingId($user->id,true);
                return ['status' => '200' , 'user' => $user];
            }else{
                return ['status' => '302'];
            }
        }else{
            return ['status' => '300'];
        }
        return ['status' => '500'];
    }

    public function get_exercise_data(){
        $exercise_list = Exercise_file::where('user_id',Auth::user()->id)->get();
        return ['status'=>'200','data' => $exercise_list];
    }

    public function get_exercise_solve_data(){
        $exercise_list_solve = Exercise_file_solve::where('user_id',Auth::user()->id)->get();
        return ['status'=>'200','data' => $exercise_list_solve];
    }

    public function get_skat(){
        $skat_list = Skat::where('user_id',Auth::user()->id)->get();
        return ['status'=>'200','data' => $skat_list];
    }

    public function pay_go_ml(Request $request){

        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'price' => $request->data['amount'] * 10,
            'res_code' => 0,
            'ip' => $request->ip(),
            'etc2' => $request->data['package']
        ]);

        $terminalId		= "1661403";							//-- شناسه ترمینال
        $userName		= "pardisf52"; 							//-- نام کاربری
        $userPassword	= "98481076"; 							//-- کلمه عبور
        $orderId		= $payment->id;								//-- شناسه فاکتور
        $amount 		= $request->data['amount'] * 10; 							//-- مبلغ به ریال
        $callBackUrl	= "https://engshooting.ut.ac.ir/api/verify_payment";	//-- لینک کال بک
        $localDate		= date('Ymd');
        $localTime		= date('Gis');  
        $additionalData	= "";
        $payerId		= 0;

        //-- تبدیل اطلاعات به آرایه برای ارسال به بانک
        $parameters = array(
            'terminalId' 		=> $terminalId,
            'userName' 			=> $userName,
            'userPassword' 		=> $userPassword,
            'orderId' 			=> $orderId,
            'amount' 			=> $amount,
            'localDate' 		=> $localDate,
            'localTime' 		=> $localTime,
            'additionalData' 	=> $additionalData,
            'callBackUrl' 		=> $callBackUrl,
            'payerId' 			=> $payerId
        );

        $client 	= new \nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
        $namespace 	='http://interfaces.core.sw.bps.com/';
        $result 	= $client->call('bpPayRequest', $parameters, $namespace);

        //-- بررسی وجود خطا
        if ($client->fault)
        {
            //-- نمایش خطا
            Payment::where('id',$payment->id)->update([
                'res_code' => "خطا در اتصال به وب سرویس بانک"
            ]);
        } else {
            
            $err = $client->getError();

            if ($err)
            {
                //-- نمایش خطا
                Payment::where('id',$payment->id)->update([
                    'res_code' => "خطا در اتصال به وب سرویس بانک"
                ]);
                return ['status' => '400'];

            } else {
                $res 		= explode (',',$result);
                $ResCode 	= $res[0];

                if ($ResCode == "0")
                {
                    Payment::where('id',$payment->id)->update([
                        'res_code' => $res[1]
                    ]);
                    //-- انتقال به درگاه پرداخت
                    return ['status'=>'200','refid'=>$res[1]];

                } else {
                    //-- نمایش خطا
                    Payment::where('id',$payment->id)->update([
                        'etc1' => $result,
                    ]);
                    return ['status' => '400'];
                }
            }
        }
    }

    public function gotopay_mellat($refid){
        return "<form name='myform' action='https://bpm.shaparak.ir/pgwchannel/startpay.mellat' method='POST'><input type='hidden' id='RefId' name='RefId' value='{$refid}'></form><script type='text/javascript'>window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>";
    }

    public function verify_payment(Request $request){
        $terminalId		= "1661403";
        $userName		= "pardisf52"; 							
        $userPassword	= "98481076"; 

        $ResCode 		= (isset($request->ResCode) && $request->ResCode != "") ? $request->ResCode : "";
           
        if ($ResCode == '0')
        {
            $client 				= new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
            $namespace 				='http://interfaces.core.sw.bps.com/';
            $orderId 				= (isset($request->SaleOrderId) && $request->SaleOrderId != "") ? $request->SaleOrderId : "";
            $verifySaleOrderId 		= (isset($request->SaleOrderId) && $request->SaleOrderId != "") ? $request->SaleOrderId : "";
            $verifySaleReferenceId 	= (isset($request->SaleReferenceId) && $request->SaleReferenceId != "") ? $request->SaleReferenceId : "";

            $parameters = array(
                'terminalId' 		=> $terminalId,
                'userName' 			=> $userName,
                'userPassword' 		=> $userPassword,
                'orderId' 			=> $orderId,
                'saleOrderId' 		=> $verifySaleOrderId,
                'saleReferenceId' 	=> $verifySaleReferenceId
            );

            $result = $client->call('bpVerifyRequest', $parameters, $namespace);

            if($result == 0)
            {
                $result = $client->call('bpSettleRequest', $parameters, $namespace);

                if($result == 0)
                {
                //-- تمام مراحل پرداخت به درستی انجام شد.
                    $pay = Payment::where('id',$request->SaleOrderId)->update([
                        'status' => 1,
                        'saleReferenceId' => $verifySaleReferenceId,
                        'etc1' => $request->ResCode
                    ]);
                    $user_has_gun = Auth::user();
                    if($user_has_gun->user_has_gun == '1'){
                        User::where('id',$user_has_gun->id)->increment('creadit_has_gun',intval($pay->etc2));
                    }else{
                        User::where('id',$user_has_gun->id)->increment('creadit_no_gun',intval($pay->etc2));
                    }
                    return view('verify_pay',['status' => '200' , 'code' => $verifySaleReferenceId,'pay'=>$pay]);
                //-- تمام مراحل پرداخت به درستی انجام شد.

                } else {
                    $client->call('bpReversalRequest', $parameters, $namespace);			
                    Payment::where('id',$request->SaleOrderId)->update([
                        'status' => 0,
                        'saleReferenceId' => $verifySaleReferenceId,
                        'etc1' => $request->ResCode,
                    ]);
                    $p = Payment::find($request->SaleOrderId);

                    return view('verify_pay',['status' => '300' , 'code' => 'خطا در ثبت درخواست واریز وجه' , 'id' => $p,'user'=>Payment::find($request->SaleOrderId)->user_id]);
                }
            } else {
                $client->call('bpReversalRequest', $parameters, $namespace);
                Payment::where('id',$request->SaleOrderId)->update([
                    'status' => 0,
                    'saleReferenceId' => $verifySaleReferenceId,
                    'etc1' => $request->ResCode,
                ]);
                $p = Payment::find($request->SaleOrderId);

                return view('verify_pay',['status' => '300' , 'code' => 'خطا در عملیات وریفای تراکنش' , 'id' => $p,'user'=>Payment::find($request->SaleOrderId)->user_id]);

            }
        } else {
            Payment::where('id',$request->SaleOrderId)->update([
                'status' => 0,
                'etc1' => $request->ResCode,
            ]);
            $p = Payment::find($request->SaleOrderId);
            return view('verify_pay',['status' => '300' , 'code' => 'تراکنش ناموفق' , 'id' => $p,'user'=>Payment::find($request->SaleOrderId)->user_id]);

        }
    }

    public function logoutpanel(){
        Auth::logout();
        return ['status' => '200'];
    }

    public function get_list_payment(){
        $payments = Payment::where('user_id',Auth::user()->id)->get();
        return ['status' => '200' , 'data' => $payments];
    }

    public function get_list_reserve(){
        $reserve = Report::where('user_id',Auth::user()->id)->where('by','کاربر')->get();
        return ['status' => '200' , 'data' => $reserve];
    }

    public function get_new_home(){
        $noti = Noti::orderBy('id','desc')->take(4)->get();
        return ['status' => '200' , 'news' => $noti];
    }

    public function allnews_id($id){
        $news = 'news-' . $id;
        if(!Session::has($news)){
            Noti::where('id',$id)->increment('etc1');
            Session::put($news,'1');
        }
        $news = Noti::where('id',$id)->first();
        return view('news',compact('news'));
    }

    public function getallnews(){
        $news = Noti::all();
        return ['status' =>'200' , 'news' => $news];
    }

    public function reserv_manager(Request $request){

        $day =  json_decode(Reserve::where('d_j',$request->data['whdate'])->first()->data);
        $id = Auth::user()->id;
        $gun = Auth::user()->has_gun;
        $w = intval($request->data['withgun']);
        $n = intval($request->data['nogun']);
        $kind_operation = ' ';
        foreach($day as $d => $k){
            if($d == $request->data['time']){
                if(!$request->data['status']){
                    $day->$d = [];

                    // if($gun == '1'){
                    //     User::where('id',$id)->decrement('creadit_has_gun');
                    //     $w--;
                    // }else{
                    //     User::where('id',$id)->decrement('creadit_no_gun');  
                    //     $n--;  
                    // }
                    $kind_operation = 'آزاد سازی جلسه';
                }else{
                    $day->$d = [];
                    array_push($day->$d,-1);

                    // if($gun == '1'){
                    //     User::where('id',$id)->increment('creadit_has_gun');
                    //     $w++;
                    // }else{
                    //     User::where('id',$id)->increment('creadit_no_gun');
                    //     $n++;    
                    // }
                    $kind_operation = 'لغو جلسه';
                }
            }
        }
        
        Reserve::where('d_j',$request->data['whdate'])->update([
            'data' => json_encode($day)
        ]);
        switch($request->data['time']){
            case 1:
                $time = '8-9:30';
                break;
            case 2:
                $time = '9:30-11';
                break;
            case 3:
                $time = '11-12:30';
                break;
            case 4:
                $time = '12:30-14';
                break;
            case 5:
                $time = '14-15:30';
                break;
            case 6:
                $time = '15:30-17';
                break;
            case 7:
                $time = '17-18:30';
                break;
            case 8:
                $time = '18:30-20';
                break;
            case 9:
                $time = '20-21:30';
                break;
        }
        Report::create([
            'user_id' => $id,
            'kind_operation' =>  $kind_operation,
            'from' =>  '',
            'to' => '',
            'gun' => Auth::user()->has_gun,
            'by' => 'مدیر',
            'etc1' => $request->data['whdate'] .' -> ساعت ('. $time . ')',
        ]);

        $now = Carbon::now()->addDays(1,'day')->format('Y-m-d');
        $next= Carbon::now()->addDays(15,'day')->format('Y-m-d');
        $data = Reserve::whereBetween('d_m',[$now,$next])->get();
        
        return ['status' => '200' , 'data' => $data , 'user' => User::where('id',$id)->first()];

    }

    public function get_price_by_userlevel(){
        $config = Configsysyem::all();
        $user = Auth::user();

        $base_price = 0;
        $off = 0;
        $off_10 = 0;
        $off_20 = 0;
        $off_30 = 0;

        foreach($config as $c){
            if($c->name == 'Off_10'){
                $off_10 = $c->value;
            }elseif($c->name == 'Off_20'){
                $off_20 = $c->value;
            }elseif($c->name == 'Off_30'){
                $off_30 = $c->value; 
            }
        }   
            if($user->has_gun == "1"){
                foreach($config as $c){
                    if($c->name == 'Price_with_gun'){
                        $base_price = $c->value;
                    }
            }
            }else{
                foreach($config as $c){
                    if($c->name == 'Price_no_gun'){
                        $base_price = $c->value;
                    }
                }
            }
            if($user->kind == '0'){
                foreach($config as $c){
                    if($c->name == 'Off_student_fanni'){
                        $off = $c->value;
                    }
                }
            }elseif($user->kind == '1'){
                foreach($config as $c){
                    if($c->name == 'Off_student'){
                        $off = $c->value;
                    }
                }

            }elseif($user->kind == '2'){
                foreach($config as $c){
                    if($c->name == 'Off_master_fanni'){
                        $off = $c->value;
                    }
                }

            }elseif($user->kind == '3'){
                foreach($config as $c){
                    if($c->name == 'Off_master'){
                        $off = $c->value;
                    }
                }
                
            }elseif($user->kind == '4'){
                $off = "1";
            }

        
        return ["off_10" => $off_10,"off_20" => $off_20,"off_30" => $off_30,"off" => $off ,"base_price" => $base_price];
        }
    
    public function verify_offcode(Request $request){
        $off_code = $request->data['off_code'];
        $user = Auth::user();
        $code = Offcode::where('name',$off_code)->first();
        if($code == null){
            return ['status'=>'300'];
        }else{
            $use_code = Offreport::where('id',$code->id)->where('status','1')->get();
            if(count($use_code) <= $code->count ){
                if(date($code->to) > date('Y-m-d')){
                    Offreport::create([
                        'user_id' => $user->id,
                        'offcode_id' => $code->id,
                        'status' => 0,
                        'price' => $code->value,
                    ]);
                    return ['status' => '200' ,'off_amount'=>$code->value];
                }else{
                    return ['status'=>'302'];
                }
            }else{
                return ['status'=>'301'];
            }
        }
    }
}

