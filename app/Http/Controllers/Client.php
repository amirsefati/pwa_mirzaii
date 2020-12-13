<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Reserve;
use App\Models\Competition;
use App\Models\Exercise_file;
use App\Models\Exercise_file_solve;
use App\Models\Report;
use App\Models\Skat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        }else{
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
                    'et2' => $img_url4,
    
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
                    'et2' => $img_url5,
    
                    'status' => '2',
                    'kind' => $request->kind
    
                ]);
            }
            
        }

        return ['status' => '200'];
    }

    public function getreserve_date(){
        $now = Carbon::now()->format('Y-m-d');
        $next= Carbon::now()->addDays(15,'day')->format('Y-m-d');
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

        $now = Carbon::now()->format('Y-m-d');
        $next= Carbon::now()->addDays(15,'day')->format('Y-m-d');
        $data = Reserve::whereBetween('d_m',[$now,$next])->get();
        
        
        return ['status' => '200' , 'data' => $data , 'user' => User::where('id',$id)->first()];
    }

    public function login(Request $request){
        $code_meli = $request->data['code_meli'];
        $password = $request->data['password'];

        if(User::where('code_meli',$code_meli)->count() > 0){
            if(User::where('password',$password)->where('code_meli',$code_meli)->count() > 0){
                $user = User::where('password',$password)->where('code_meli',$code_meli)->first();
                Auth::loginUsingId($user->id);
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
}
