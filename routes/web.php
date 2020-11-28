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

});

Route::prefix('api')->group(function(){

    Route::get('getlearn',[Client::class,'getlearn']);
    Route::get('getcourse',[Client::class,'getcourse']);
    Route::get('getgallery',[Client::class,'getgallery']);


    
});