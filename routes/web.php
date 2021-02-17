<?php

use App\Http\Controllers\Client;
use App\Http\Controllers\Manager;
use App\Models\Payment;
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

Route::get('/haha/verify',function(){
    $pay = Payment::find(23);
    return view('verify_pay',['status' => '300' , 'code' => '12320349923','id'=>$pay]);

});

Route::prefix('manager')->group(function(){
    #dashboard _Panel_Manager 
    Route::get('/index/{id}',[Manager::class,'index']);
    

    
    Route::get('report_user_info',[Manager::class,'report_user_info']);
    Route::get('report_user_info_user/{id}',[Manager::class,'report_user_info_user']);
    
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

    #Noti
    Route::get('add_noti',[Manager::class,'add_noti']);
    Route::post('add_noti_post',[Manager::class,'add_noti_post']);

    Route::get('manage_noti',[Manager::class,'manage_noti']);
    Route::get('noti/delete_noti/{id}',[Manager::class,'delete_noti']);
    Route::get('noti/edit_noti/{id}',[Manager::class,'edit_noti']);
    Route::post('edit_noti_post',[Manager::class,'edit_noti_post']);



    #user
    Route::get('user_no_verify',[Manager::class,'user_no_verify']);
    Route::get('all_user',[Manager::class,'all_user']);
    Route::get('user/edit_user/{id}',[Manager::class,'edit_user']);

    Route::post('verify_user_account',[Manager::class,'verify_user_account']);

    Route::get('alireza',[Manager::class,'create_reserve_data']);

    Route::get('credit',[Manager::class,'creadit']);
    Route::get('credit/{id}',[Manager::class,'creadit_user']);

    Route::post('add_credit_touser_byadmin',[Manager::class,'add_credit_touser_byadmin']);

    
    
    #three section Header 
    Route::get('exercise_file',[Manager::class,'exercise_file']);
    Route::get('exercise_file/{id}',[Manager::class,'exercise_file_user']);
    Route::post('exercise_file_upload',[Manager::class,'exercise_file_upload']);
    Route::get('exercise_file_upload_dl/{id}',[Manager::class,'exercise_file_upload_dl']);

    
    Route::get('solve_exercise_file',[Manager::class,'solve_exercise_file']);
    Route::get('solve_exercise_file_list/{id}',[Manager::class,'solve_exercise_file_list']);
    Route::get('solve_exercise_file_list_item/{id}',[Manager::class,'solve_exercise_file_list_item']);
    Route::post('solve_exercise_file_list_item_upload',[Manager::class,'solve_exercise_file_list_item_upload']);
    Route::get('exercise_file_upload_dl_solve/{id}',[Manager::class,'exercise_file_upload_dl_solve']);

    
    Route::get('skat',[Manager::class,'skat']);
    Route::get('skat/{id}',[Manager::class,'skat_file_user']);
    Route::get('add_skat/{id}',[Manager::class,'add_skat']);
    Route::post('skat_file_upload',[Manager::class,'skat_file_upload']);
    Route::get('dl_skat/{id}',[Manager::class,'dl_skat']);

    
    Route::get('coach_list',[Manager::class,'coach_list']);
    Route::get('to_student/{id}',[Manager::class,'to_student']);
    Route::get('to_couch/{id}',[Manager::class,'to_couch']);
    Route::get('show_couch/{id}',[Manager::class,'show_couch']);
    Route::post('add_userto_couach',[Manager::class,'add_userto_couach']);
    Route::get('dl_couch_from_student/{id}',[Manager::class,'dl_couch_from_student']);
    
    Route::get('reserve_by_admin',[Manager::class,'reserve_by_admin']);
    Route::post('reserved_by_admin',[Manager::class,'reserved_by_admin']);

    
    Route::get('report_reserve',[Manager::class,'report_reserve']);

    Route::get('settings',[Manager::class,'settings']);

    Route::post('add_setttings',[Manager::class,'add_setttings']);

    Route::get('off_code',[Manager::class,'off_code']);

    Route::post('add_coupen',[Manager::class,'add_coupen']);

    Route::get('delete_coupen/{id}',[Manager::class,'delete_coupen']);

    
    Route::get('report_payment',[Manager::class,'report_payment']);

});

Route::prefix('couch')->group(function(){
    Route::get('c_list_student',[Manager::class,'c_list_student']);
    Route::get('c_student/{id}',[Manager::class,'c_student']);
    Route::post('add_solve_exercise',[Manager::class,'add_solve_exercise']);
    Route::post('add_solve_skat',[Manager::class,'add_solve_skat']);

    
    
});

Route::prefix('news')->group(function(){
    Route::get('allnews',[Client::class,'allnews']);
    Route::get('allnews/{id}',[Client::class,'allnews_id']);

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

    Route::post('login',[Client::class,'login']);

    Route::get('get_exercise_data',[Client::class,'get_exercise_data']);

    Route::get('get_exercise_solve_data',[Client::class,'get_exercise_solve_data']);

    Route::get('get_skat',[Client::class,'get_skat']);

    Route::post('pay_go_ml',[Client::class,'pay_go_ml']);
    
    Route::get('gotopay/{refid}',[Client::class,'gotopay_mellat']);

    Route::post('verify_payment',[Client::class,'verify_payment']);

    Route::get('logoutpanel',[Client::class,'logoutpanel']);

    Route::get('get_list_payment',[Client::class,'get_list_payment']);

    Route::get('get_list_reserve',[Client::class,'get_list_reserve']);

    Route::get('get_new_home',[Client::class,'get_new_home']);

    Route::get('getallnews',[Client::class,'getallnews']);

    Route::post('reserv_manager',[Client::class,'reserv_manager']);

    Route::get('get_price_by_userlevel',[Client::class,'get_price_by_userlevel']);

    Route::post('verify_offcode',[Client::class,'verify_offcode']);

    
});