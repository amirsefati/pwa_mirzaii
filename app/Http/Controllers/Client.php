<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Gallery;
use App\Models\News;
use Illuminate\Http\Request;

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
}
