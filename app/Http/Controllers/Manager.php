<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\News;
use App\Models\Skat;
use App\Models\User;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Reserve;
use Carbon\Traits\Date;
use App\Models\Competition;
use App\Models\Configsysyem;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use App\Models\Exercise_file;
use App\Models\Exercise_file_solve;
use App\Models\Noti;
use App\Models\Offcode;
use App\Models\Payment;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class Manager extends Controller
{
    public function index($id){
        $now = Carbon::now()->format('Y-m-d');
        $next= Carbon::now()->addDays($id,'day')->format('Y-m-d');
        $data = Reserve::whereBetween('d_m',[$now,$next])->orderBy('id','DESC')->first();
        return view('dashboard.index',compact('data'));
    }

    public function add_learn(){
        return view('dashboard.add_learn');
    }

    public function add_learn_post(Request $request){
        $request->validate([
            'title' => 'required|max:200',
            'author' => 'required|max:200',
            'cate' => 'required|max:200',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/news/');
            $image->move($destinationPath, $name);
            $img_url = '/public/news/' . $name ;
        }
        
        News::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'desc'=>$request->desc,
            'cate'=>$request->cate,
            'hashtag'=>$request->cate,

            'img'=>$img_url,

        ]);
        return redirect('manager/manage_learn');
    }

    public function manage_learn(){
        $news_list = News::all();
        return view('dashboard.manage_learn',compact('news_list'));
    }

    public function delete_news($id){
        News::where('id',$id)->delete();
        return redirect('/manager/manage_learn');
    }

    public function edit_news($id){
        $news = News::where('id',$id)->first();
        return view('dashboard.edit_learn',compact('news'));
    }

    public function edit_learn_post(Request $request){
        $request->validate([
            'title' => 'required|max:200',
            'author' => 'required|max:200',
            'cate' => 'required|max:10000',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/news/');
            $image->move($destinationPath, $name);
            $img_url = '/public/news/' . $name ;
        }

        News::where('id',$request->id)->update([
            'title'=>$request->title,
            'author'=>$request->author,
            'desc'=>$request->desc,
            'cate'=>$request->cate,
            'hashtag'=>$request->cate,

            'img'=>$img_url,
        ]);

        return redirect('/manager/manage_learn');
    }


    ########### Noti

    public function add_noti(){
        return view('dashboard.add_noti');
    }

    public function add_noti_post(Request $request){

        $request->validate([
            'title' => 'required|max:200',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/noti/');
            $image->move($destinationPath, $name);
            $img_url = '/public/noti/' . $name ;
        }
        
        Noti::create([
            'title'=>$request->title,
            'desc'=>$request->desc,
            'link'=>$request->link,
            'hashtag'=>$request->hashtag,
            'level'=>$request->level,
            'img'=>$img_url,
        ]);
        return redirect('manager/manage_noti');
    }

    public function manage_noti(){
        $noti_list = Noti::all();
        return view('dashboard.manage_noti',compact('noti_list'));
    }

    public function delete_noti($id){
        Noti::where('id',$id)->delete();
        return redirect('/manager/manage_noti');
    }

    public function edit_noti($id){
        $noti = Noti::where('id',$id)->first();
        return view('dashboard.edit_noti',compact('noti'));
    }

    public function edit_noti_post(Request $request){
        $request->validate([
            'title' => 'required|max:250',
            'img' => 'max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp'
        ]);

        $img_url = "";
        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/noti/');
            $image->move($destinationPath, $name);
            $img_url = '/public/noti/' . $name ;
        }
        Noti::where('id',$request->id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'link' => $request->link,
            'hashtag' => $request->hashtag,
            'level' => $request->level,
           
            'img'=>$img_url,

        ]);

        return redirect('/manager/manage_noti');
    }


    ########### course
    public function add_course(){
        return view('dashboard.add_course');
    }

    public function add_course_post(Request $request){

        $request->validate([
            'title' => 'required|max:200',
            'author' => 'required|max:200',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/course/');
            $image->move($destinationPath, $name);
            $img_url = '/public/course/' . $name ;
        }
        
        Course::create([
            'title'=>$request->title,
            'author'=>$request->author,
            'desc'=>$request->desc,
            
            'count_hourse'=>$request->count_hourse,
            'price'=>$request->price,
            'deadline'=>$request->deadline,
            'documents'=>$request->documents,
            'starting'=>$request->starting,
            'quantity'=>$request->quantity,
            'hourse'=> '1',
            'etc'=> $request->etc,

            'img'=>$img_url,

        ]);
        return redirect('manager/manage_course');
    }

    public function manage_course(){
        $course_list = Course::all();
        return view('dashboard.manage_course',compact('course_list'));
    }

    public function delete_course($id){
        Course::where('id',$id)->delete();
        return redirect('/manager/manage_course');
    }

    public function edit_course($id){
        $course = Course::where('id',$id)->first();
        return view('dashboard.edit_course',compact('course'));
    }

    public function edit_course_post(Request $request){
        $request->validate([
            'title' => 'required|max:250',
            'author' => 'required|max:250',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp'
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/course/');
            $image->move($destinationPath, $name);
            $img_url = '/public/course/' . $name ;
        }
        Course::where('id',$request->id)->update([
            'title' => $request->title,
            'author' => $request->author,
            'desc' => $request->desc,
            'count_hourse' => $request->count_hourse,
            'price' => $request->price,
            'deadline' => $request->deadline,
            'documents' => $request->documents,
            'starting' => $request->starting,
            'quantity' => $request->quantity,
            'etc' => $request->etc,
            'hourse' => $request->hourse,
            'img'=>$img_url,

        ]);

        return redirect('/manager/manage_course');
    }


    public function add_gallery(){
        return view('dashboard.add_gallery');
    }

    public function add_gallery_post(Request $request){
        $request->validate([
            'title' => 'required',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
            'images' => 'required',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/course/');
            $image->move($destinationPath, $name);
            $img_url = '/public/course/' . $name ;
        }

        $all_images = [];
        foreach($request->images as $iimg){
            $image = $iimg;
            $name = rand(100000,9999999999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/gallery/');
            $image->move($destinationPath, $name);
            $file_item = '/gallery/' . $name ; 
            array_push($all_images,$file_item);
        }

        Gallery::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'desc2' => $request->desc2,
            'times' => $request->times,
            'kind' => $request->kind,
            'hashtag' => $request->hashtag,
            'img' => $img_url,
            'images' => json_encode($all_images),
        ]);

        return redirect('/manager/manage_gallery');
    }

    public function manage_gallery(){
        $gallery_list = Gallery::all();
        return view('dashboard.manage_gallery',compact('gallery_list'));
    }

    public function delete_gallery($id){
        Gallery::where('id',$id)->delete();
        return redirect('/manager/manage_gallery');
    }

    public function edit_gallery($id){
        $gallery = Gallery::where('id',$id)->first();
        return view('dashboard.edit_gallery',compact('gallery'));
    }

    public function edit_gallery_post(Request $request){
        $request->validate([
            'title' => 'required',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
            'images' => 'required',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/course/');
            $image->move($destinationPath, $name);
            $img_url = '/public/course/' . $name ;
        }

        $all_images = [];
        foreach($request->images as $iimg){
            $image = $iimg;
            $name = rand(100000,9999999999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/gallery/');
            $image->move($destinationPath, $name);
            $file_item = '/gallery/' . $name ; 
            array_push($all_images,$file_item);
        }

        Gallery::where('id',$request->id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'desc2' => $request->desc2,
            'times' => $request->times,
            'kind' => $request->kind,
            'hashtag' => $request->hashtag,
            'img' => $img_url,
            'images' => json_encode($all_images),
        ]);
        return redirect('/manager/manage_gallery');
    }

    public function add_competition(){
        return view('dashboard.add_competition');
    }

    public function add_competition_post(Request $request){

        $request->validate([
            'title' => 'required|max:200',
            'timer' => 'required|max:200',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/competition/');
            $image->move($destinationPath, $name);
            $img_url = '/public/competition/' . $name ;
        }
        
        Competition::create([
            'title'=>$request->title,
            'timer'=>$request->timer,
            'desc'=>$request->desc,
            
            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'award'=>$request->award,
            'conditions'=>$request->conditions,
            'link_signup'=>$request->link_signup,
            'etc' => $request->etc,

            'img'=>$img_url,

        ]);
        return redirect('manager/manage_competition');

    }

    public function manage_competition(){
        $competition_list = Competition::all();
        return view('dashboard.manage_competition',compact('competition_list'));
   
    }

    public function delete_competition($id){
        Competition::where('id',$id)->delete();
        return redirect('/manager/manage_competition');
    }

    public function edit_competition($id){
        $competition = Competition::where('id',$id)->first();
        return view('dashboard.edit_competition',compact('competition'));
    }

    public function edit_competition_post(Request $request){
        $request->validate([
            'title' => 'required|max:250',
            'timer' => 'required|max:250',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp'
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/competition/');
            $image->move($destinationPath, $name);
            $img_url = '/public/competition/' . $name ;
        }
        Competition::where('id',$request->id)->update([
            'title' => $request->title,
            'timer' => $request->timer,
            'desc' => $request->desc,

            'quantity'=>$request->quantity,
            'price'=>$request->price,
            'award'=>$request->award,
            'conditions'=>$request->conditions,
            'link_signup'=>$request->link_signup,
            'etc' => $request->etc,
            'img'=>$img_url,

        ]);

        return redirect('/manager/manage_competition');
    
    }


    public function add_coach(){
        return view('dashboard.add_coach');
    }

    public function add_coach_post(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp',
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/coach/');
            $image->move($destinationPath, $name);
            $img_url = '/public/coach/' . $name ;
        }
        
        Coach::create([
            'name'=>$request->name,
            'kind'=>$request->kind,
            'desc'=>$request->desc,
            
            'hashtag'=>$request->hashtag,
            'rank_show'=>$request->rank_show,
            'guns'=>$request->guns, 

            'img'=>$img_url,

        ]);
        return redirect('manager/manage_coach');
  
    }

    public function manage_coach(){
        $coach_list = Coach::all();
        return view('dashboard.manage_coach',compact('coach_list'));
    }

    public function delete_coach($id){
        Coach::where('id',$id)->delete();
        return redirect('/manager/manage_coach');
    }

    public function edit_coach($id){
        $coach = Coach::where('id',$id)->first();
        return view('dashboard.edit_coach',compact('coach'));
    }

    public function edit_coach_post(Request $request){
        $request->validate([
            'name' => 'required|max:250',
            'img' => 'required|max:5000|mimes:png,jpg,jpeg,ttf,gif,bmp'
        ]);

        if($request->hasFile('img')){
            $image = $request->file('img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/coach/');
            $image->move($destinationPath, $name);
            $img_url = '/public/coach/' . $name ;
        }
        Coach::where('id',$request->id)->update([
            'name'=>$request->name,
            'kind'=>$request->kind,
            'desc'=>$request->desc,
            
            'hashtag'=>$request->hashtag,
            'rank_show'=>$request->rank_show,
            'guns'=>$request->guns, 

            'img'=>$img_url,

        ]);

        return redirect('/manager/manage_coach');
    
    }


    ############################ User 
    public function user_no_verify(){
        
        $no_verify = User::where('status','<',3)->get();
        return view('dashboard.users.user_no_verify',compact('no_verify'));
    }

    public function edit_user($id){
        $user = User::where('id',$id)->first();
        return view('dashboard.users.edit_user',compact('user'));
    }

    public function all_user(){
        $users = User::where('status', '>' ,1)->get();
        return view('dashboard.users.all_user',compact('users'));
    }

    public function verify_user_account(Request $request){

        
        $scan_shenasname = $request->scan_shenasname;
        if($request->hasFile('scan_shenasname_n')){
            $image = $request->file('scan_shenasname_n');
            $name = rand(100,99999).'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/documents/');
            $image->move($destinationPath, $name);
            $scan_shenasname = '/public/documents/' . $name ;
        }

        $scan_pic = $request->scan_pic;
        if($request->hasFile('scan_pic_n')){
            $image = $request->file('scan_pic_n');
            $name = rand(100,99999).'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/documents/');
            $image->move($destinationPath, $name);
            $scan_pic = '/public/documents/' . $name ;
        }

        $scan_bime = $request->scan_bime;
        if($request->hasFile('scan_bime_n')){
            $image = $request->file('scan_bime_n');
            $name = rand(100,99999).'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/documents/');
            $image->move($destinationPath, $name);
            $scan_bime = '/public/documents/' . $name ;
        }

        $etc2 = $request->etc2;
        if($request->hasFile('etc2_n')){
            $image = $request->file('etc2_n');
            $name = rand(100,99999).'-'.time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/documents/');
            $image->move($destinationPath, $name);
            $etc2 = '/public/documents/' . $name ;
        }

        User::where('id',$request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'code_meli' => $request->code_meli,
            'born' => $request->born,
            'kind' => $request->kind,
            'email' => $request->email,
            'has_gun' => $request->has_gun,
            'password' => $request->password,

            'scan_shenasname' => $scan_shenasname,
            'scan_pic' => $scan_pic,
            'scan_bime' => $scan_bime,
            'etc2' => $etc2,

            'status' => 3
        ]);
        return redirect('/manager/all_user');

    }

    public function create_reserve_data(){

        $now = Jalalian::forge('today');
        $now = explode(" ",$now);
        $now = explode("-",$now[0]);
        for($d = 0 ; $d < 40 ; $d++){
            $date_j = (new Jalalian($now[0],$now[1],$now[2]))->addDays($d)->format('Y-m-d (%A)');
            $date_m = Carbon::now()->addDays($d,'day')->format('Y-m-d');
            $data = [1=>[],2=>[],3=>[],4=>[],5=>[],6=>[],7=>[],8=>[],9=>[]];
            if(Reserve::where('d_m',$date_m)->count() < 1 ){
                Reserve::create([
                    'd_j' => $date_j,
                    'd_m' => $date_m,
                    'data' => json_encode($data)
                ]);
            }
        }
        return 'ok';
    }

    public function creadit(){
        $users = User::where('status','3')->get();
        return view('dashboard.users.credit',compact('users'));
    }

    public function creadit_user($id){
        $user = User::find($id);
        return view('dashboard.users.creadit_user',compact('user'));
    }
    public function add_credit_touser_byadmin(Request $request){
        Report::create([
            'user_id' => $request->id,
            'kind_operation' => 'مدیر اعتبار',
            'gun' => $request->has_gun_id,
            'price' => 0,
            'from' => $request->from,
            'to' => 'w:(' . $request->has_gun . ')' . 'n:(' . $request->no_gun .')',
            'by' => 'مدیر',
            'info' => 'اعتبار مدیریت'
        ]);
        if($request->has_gun_id == '1'){
            User::where('id',$request->id)->update([
                'creadit_has_gun' => $request->has_gun,
            ]);
        }else{
            User::where('id',$request->id)->update([
                'creadit_no_gun' => $request->no_gun,
            ]);
        }
        

        return redirect('/manager/credit');
    }

    public function exercise_file(){
        $users = User::where('status','>',2)->get();
        return view('dashboard.three_section.exercise_file',compact('users'));
    }
    public function exercise_file_user($id){
        $user = User::where('id',$id)->first();
        $user_data = Exercise_file::where('user_id',$id)->get();
        return view('dashboard.three_section.exercise_file_user',compact(['user','user_data']));
    }

    public function exercise_file_upload(Request $request){
        

        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = $request->user_id . "-" . rand(1000,99999999) . '-' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/exercise_file/');
            $image->move($destinationPath, $name);
            $img_url = '/public/exercise_file/' . $name ;
        }

        Exercise_file::create([
            'user_id' => $request->user_id,
            'time' => $request->date,
            'tag' => $request->tag,
            'file' => $img_url,
        ]);
        
        return back();
    }

    public function exercise_file_upload_dl($id){
        Exercise_file::where('id',$id)->delete();
        return back();
    }

    public function solve_exercise_file(){
        $users = User::where('status','>',2)->get();
        return view('dashboard.three_section.solve_exercise_file',compact('users'));
    }

    public function solve_exercise_file_list($id){
        $list = Exercise_file::where('id',$id)->get();
        return view('dashboard.three_section.solve_exercise_file_list',compact(['list','id']));
    }

    public function solve_exercise_file_list_item($id){
        $item = Exercise_file::where('id',$id)->first();
        return view('dashboard.three_section.solve_exercise_file_list_item',compact('item'));

    }

    public function solve_exercise_file_list_item_upload(Request $request){

        $img_url = '';
        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = $request->user_id . "-" . rand(1000,99999999) . '-' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/solve_exercise_file/');
            $image->move($destinationPath, $name);
            $img_url = '/public/solve_exercise_file/' . $name ;
        }

        Exercise_file_solve::updateOrCreate(
            ['exercise_files_id' => $request->comment_id,],
            [
            'user_id' => $request->user_id  ,
            'exercise_files_id' => $request->comment_id,
            'comment' => $request->comment,
            'file' => $img_url,
        ]);

        return back();
    }

    public function exercise_file_upload_dl_solve($id){
        Exercise_file_solve::where('id',$id)->delete();
        return back();
    }

    public function skat(){
        $users = User::where('status','>',2)->get();
        return view('dashboard.three_section.skat',compact('users'));
    }

    public function skat_file_user($id){
        $list = Skat::where('user_id',$id)->get();
        return view('dashboard.three_section.skat_list',compact(['list','id']));
    }

    public function add_skat($id){
        return view('dashboard.three_section.add_skat',compact('id'));
    }

    public function skat_file_upload(Request $request){

        $img_url = '';
        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = $request->user_id . "-" . rand(1000,99999999) . '-' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/skat/');
            $image->move($destinationPath, $name);
            $img_url = '/public/skat/' . $name ;
        }

        Skat::create([
            'user_id' => $request->user_id,
            'time' => $request->date,
            'comment' => $request->comment,
            'file' => $img_url,

        ]);

        return back();
    }

    public function dl_skat($id){
        Skat::where('id',$id)->delete();
        return back();
    }

    public function coach_list(){
        $users = User::where('status','>',2)->get();
        return view('dashboard.coush_list',compact('users'));
    }

    public function to_student($id){
        User::where('id',$id)->update([
            'etc' => null
        ]);
        return back();
    }

    public function to_couch($id){
        User::where('id',$id)->update([
            'etc' => 1
        ]);
        return back();
    }

    public function show_couch($id){
        $users = User::where('status','>',2)->get();
        return view('dashboard.show_couch',compact(['users','id']));
    }

    public function add_userto_couach(Request $request){
        User::where('id',$request->user_id)->update([
            'etc1' => $request->couch_user_id
        ]);
        return back();
    }

    public function dl_couch_from_student($id){
        User::where('id',$id)->update([
            'etc1' => null
        ]);
        return back();
    }



    ###########Couch Section
    public function c_list_student(){
        $student = User::where('etc1',Auth::user()->id)->get();
        return view('couch.c_list_student',compact('student'));
    }

    public function c_student($id){
        if(User::where('id',$id)->where('etc1',Auth::user()->id)->count() > 0){
            $exercise_list = Exercise_file::where('user_id',$id)->get();
            $skat_list = Skat::where('user_id',$id)->get();
            $user = User::find($id);
            return view('couch.c_student',compact(['user','exercise_list','skat_list']));
        }else{
            return 'دست رسی به این کاربر برای شما امکان پذیز نیست';
        }
    }

    public function add_solve_exercise(Request $request){

        $img_url = '';
        if($request->hasFile('file')){
            $image = $request->file('file');
            $name =  $request->student_id . "-" . rand(1000,99999999) . '-' . time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/solve_exercise_file/');
            $image->move($destinationPath, $name);
            $img_url = '/public/solve_exercise_file/' . $name ;
        }

        Exercise_file_solve::create([
            'exercise_files_id' => $request->file_exercise,
            'user_id' => $request->student_id,
            'comment' => $request->comment,
            'file' => $img_url,
        ]);

        return back();
    }

    public function add_solve_skat(Request $request){

        Skat::where('id',$request->skat_id)->update([
            'comment' => $request->comment
        ]); 
        return back();
    }

    public function reserve_by_admin(){
        return view('dashboard.reserve_by_admin');
    }

    public function reserved_by_admin(Request $request){
        
        $payment = Payment::create([
            'user_id' => Auth::user()->id,
            'price' => $request->price * 10,
            'res_code' => 0,
            'ip' => $request->ip(),
            'etc2' => 1
        ]);

        Report::create([
            'user_id' => Auth::user()->id,
            'kind_operation' => $request->kind_operation,
            'gun' => $request->gun,
            'price' => $request->price,
            'etc1' => $request->etc1,
            'from' => 0,
            'to' => 0,
            'by' => 'رزرو توسط مدیر',
            'info' => $request->info,
            'etc2' => $payment->id
        ]);

        $terminalId		= "1661403";							//-- شناسه ترمینال
        $userName		= "pardisf52"; 							//-- نام کاربری
        $userPassword	= "98481076"; 							//-- کلمه عبور
        $orderId		= $payment->id;								//-- شناسه فاکتور
        $amount 		= $request->price * 10; 							//-- مبلغ به ریال
        $callBackUrl	= "https://engshooting.ut.ac.ir/api/verify_payment";	//-- لینک کال بک
        $localDate		= date('Ymd');
        $localTime		= date('Gis');  
        $additionalData	= "";
        $payerId		= '1703522522157';

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
                    return "<form name='myform' action='https://bpm.shaparak.ir/pgwchannel/startpay.mellat' method='POST'><input type='hidden' id='RefId' name='RefId' value='{$res[1]}'></form><script type='text/javascript'>window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>";
                } else {
                    //-- نمایش خطا
                    Payment::where('id',$payment->id)->update([
                        'etc1' => $result,
                    ]);
                    return ['status' => 'خطا در انتقال به بانک'];
                }
            }
        }

    }

    public function report_reserve(){
        $payment = Report::orderBy('created_at','DESC')->get();
        return view('dashboard.report_reserve',compact('payment'));
    }

    public function settings(){
        $configs = Configsysyem::all();
        return view('dashboard.settings',compact('configs'));
    }

    public function add_setttings(Request $request){
        Configsysyem::updateOrCreate(
            ['name' => $request->name],
            [
                'name' => $request->name,
                'value' => $request->value,
 
            ]
        );
        return back();
    }

    public function off_code(){
        $coupen = Offcode::all();
        return view('dashboard.off_code',compact('coupen'));
    }

    public function add_coupen(Request $request){
        Offcode::create([
            'name' => $request->name,
            'kind' => $request->kind,
            'value' => $request->value,
            'from' => $request->from,
            'to' => $request->to,
            'count' => $request->count,
            'kind_user' => $request->kind_user,
        ]);
        return back();
    }

    public function delete_coupen($id){
        Offcode::find($id)->delete();
        return back();
    }

    public function report_user_info(){
        $users = User::where('status','>','2')->get();
        return view('dashboard.report_user_info',compact('users'));
    }

    public function report_user_info_user($id){
        $payment = Payment::where('user_id',$id)->get();
        $report = Report::where('user_id',$id)->get();
        $user = User::find($id);
        return view('dashboard.report_user_info_user',compact(['payment','report','user']));
    }

    public function report_payment(){
        $payment = Payment::orderBy('created_at','DESC')->get();
        return view('dashboard.report_payment',compact('payment'));
    }
}
