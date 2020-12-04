<?php

use App\Http\Controllers\Client;
use App\Http\Controllers\Manager;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    return view('welcome');
});
Route::get('/{any}', function () {
    return view('welcome');
});


Route::prefix('manager')->group(function(){
    #dashboard _Panel_Manager 
    Route::get('dashboard',[Manager::class,'index']);
    
    #Learn
    Route::get('add_learn',[Manager::class,'add_learn']);
    Route::post('add_learn_post',[Manager::class,'add_learn_post']);

    Route::get('manage_learn',[Manager::class,'manage_learn']);
    Route::get('news/delete_news/{id}',[Manager::class,'delete_news']);
    Route::get('news/edit_news/{id}',[Manager::class,'edit_news']);
    Route::post('edit_learn_post',[Manager::class,'edit_learn_post']);


    #course
    Route::get('add_course',[Manager::class,'add_course']);
    Route::post('add_course_post',[Manager::class,'add_course_post']);

    Route::get('manage_course',[Manager::class,'manage_course']);
    Route::get('course/delete_course/{id}',[Manager::class,'delete_course']);
    Route::get('course/edit_course/{id}',[Manager::class,'edit_course']);
    Route::post('edit_course_post',[Manager::class,'edit_course_post']);

    
    #Gallery
    Route::get('add_gallery',[Manager::class,'add_gallery']);
    Route::post('add_gallery_post',[Manager::class,'add_gallery_post']);

    Route::get('manage_gallery',[Manager::class,'manage_gallery']);
    Route::get('gallery/delete_gallery/{id}',[Manager::class,'delete_gallery']);
    Route::get('gallery/edit_gallery/{id}',[Manager::class,'edit_gallery']);
    Route::post('edit_gallery_post',[Manager::class,'edit_gallery_post']);


    #competition
    Route::get('add_competition',[Manager::class,'add_competition']);
    Route::post('add_competition_post',[Manager::class,'add_competition_post']);

    Route::get('manage_competition',[Manager::class,'manage_competition']);
    Route::get('competition/delete_competition/{id}',[Manager::class,'delete_competition']);
    Route::get('competition/edit_competition/{id}',[Manager::class,'edit_competition']);
    Route::post('edit_competition_post',[Manager::class,'edit_competition_post']);


    #couch 
    Route::get('add_coach',[Manager::class,'add_coach']);
    Route::post('add_coach_post',[Manager::class,'add_coach_post']);

    Route::get('manage_coach',[Manager::class,'manage_coach']);
    Route::get('coach/delete_coach/{id}',[Manager::class,'delete_coach']);
    Route::get('coach/edit_coach/{id}',[Manager::class,'edit_coach']);
    Route::post('edit_coach_post',[Manager::class,'edit_coach_post']);



    #user
    Route::get('user_no_verify',[Manager::class,'user_no_verify']);
    Route::get('all_user',[Manager::class,'all_user']);
    Route::get('user/edit_user/{id}',[Manager::class,'edit_user']);

    Route::post('verify_user_account',[Manager::class,'verify_user_account']);

    Route::get('alireza',[Manager::class,'create_reserve_data']);
 
    
});

Route::prefix('api')->group(function(){

    Route::get('getlearn',[Client::class,'getlearn']);
    Route::get('getcourse',[Client::class,'getcourse']);
    Route::get('getgallery',[Client::class,'getgallery']);
    Route::get('getcompetition',[Client::class,'getcompetition']);
    Route::get('getcoach',[Client::class,'getcoach']);

    Route::get('checklogin',[Client::class,'checklogin']);

    Route::post('register_attempt',[Client::class,'register_attempt']);

    Route::post('upload_img_v',[Client::class,'upload_img_v']);

    Route::get('getreserve_date',[Client::class,'getreserve_date']);

    Route::post('reserv',[Client::class,'reserv']);

    
});