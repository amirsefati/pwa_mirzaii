<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Coach;
use App\Models\Course;
use App\Models\Gallery;
use App\Models\Competition;
use App\Models\Reserve;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class Manager extends Controller
{
    public function index(){
        return view('dashboard.index');
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
            $img_url = '/news/' . $name ;
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
            $img_url = '/news/' . $name ;
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
            $img_url = '/course/' . $name ;
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
            $img_url = '/course/' . $name ;
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
            $img_url = '/course/' . $name ;
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
            $img_url = '/course/' . $name ;
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
            $img_url = '/competition/' . $name ;
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
            $img_url = '/competition/' . $name ;
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
            $img_url = '/coach/' . $name ;
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
            $img_url = '/coach/' . $name ;
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
    
        User::where('id',$request->id)->update([
            'status' => 3
        ]);
        return redirect('/manager/all_user');

    }

    public function create_reserve_data(){

        $now = Jalalian::forge('today');
        $now = explode(" ",$now);
        $now = explode("-",$now[0]);
        for($d = 0 ; $d < 15 ; $d++){
            $date_j = (new Jalalian($now[0],$now[1],$now[2]))->addDays($d)->format('Y-m-d (%A)');
            $date_m = Carbon::now()->addDays($d,'day')->format('Y-m-d');
            $data = [1=>[12,45,34,4,34],2=>[77,65,64,3],3=>[],4=>[44,3],5=>[],6=>[],7=>[],8=>[],9=>[]];
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
    public function add_credit_touser(Request $request){
        User::where('id',$request->id)->update([
            'creadit_has_gun' => $request->has_gun,
            'creadit_no_gun' => $request->no_gun,
        ]);

        return redirect('/manager/credit');
    }

}
