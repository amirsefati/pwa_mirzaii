<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

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
}
