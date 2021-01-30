<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>آکادمی تیراندازی دانشکده فنی</title>
        <link rel="shortcut icon" href="{{asset('images/fani_t.png')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/news.css')}}">
        <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazir-font@v26.0.2/dist/font-face.css" rel="stylesheet" type="text/css" />
        <style>
            
            
            
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row fani_menu" id="sticky_navbar">
                <div class="col-md-3 col-3"></div>
                <div class="col-md-6 col-6 pt-3 pl-1 pr-1" style="text-align: center;">
                    <a href="/" style="color: white;">آکادمی تیراندازی دانشکده فنی</a>
                </div>
                <div class="col-md-3 col-3" style="text-align: right;padding-top:10px;padding-right: 28px;"><a href="/" aria-current="page" class="router-link-exact-active router-link-active"><img src="/images/home.png?cecc5a0042910280423fb6ea533164b8" alt="" style="width: 30px;"></a></div>

            </div>
            <div class="row">
                <div class="col-md-12 fani_bg">

                </div>
            </div>  

            <div style="padding: 15px;">
            <div class="row">
                <div class="col-md-12 p-2 center" >
                    <p style="font-size: 11px;margin:3px">{{\Morilog\Jalali\Jalalian::forge('today')->format('%A, %d %B %y')}}</p>
                    <p style="font-size: 22px;">بخش اخبار</p>
                </div>
            </div>

            <div class="row center content_news" style="color:gray">
                <div class="col-md-4 col-4 br_top" style="font-size: 12px;"> تاریخ انتشار  : <small>{{\Morilog\Jalali\CalendarUtils::strftime('Y-m-d H:i:s', strtotime($news->created_at))}}</small></div>

                <div class="col-md-4 col-4 br_top" style="font-size: 12px;"> دسته بندی :{{$news->hashtag}}</div>
                <div class="col-md-4 col-4 br_top" style="font-size: 12px;">  کدخبر : <small>{{$news->id * 150}}</small></div>

            </div>

            <div class="row center content_news" style="direction:rtl">
                <div class="col-md-12">
                <p style="font-size: 20px;">{{$news->title}}</p>
                <div class="row">
                    <div class="col-md-2 col-4">
                        <p style="font-size:12px;margin:0px;color:gray">بازدید : {{$news->etc1}} نفر</p>
                    </div>
                    <div class="col-md-2 col-5">
                        <p style="font-size:12px;margin:0px;color:gray">اهمیت : {{$news->level == 1 ? 'متوسط' : 'بالا'}} </p>
                    </div>
                </div>
                <hr>
                {{strip_tags($news->desc)}}
                </div>
            </div>
            </div>
        </div>


        <script>
            window.onscroll = function() {
    scrollfunction()
}
var navbar = document.getElementById('sticky_navbar')
var sticky_navbar = navbar.offsetTop

function scrollfunction(){
    if(window.pageYOffset > sticky_navbar){
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }

}

    
        </script>
    </body>

</html>
