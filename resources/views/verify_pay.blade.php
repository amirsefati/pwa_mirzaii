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
                    <a href="/" style="color:white;">آکادمی تیراندازی دانشکده فنی</a>
                </div>
                <div class="col-md-3 col-3" style="text-align: right;padding-top:10px;padding-right: 28px;"><a href="/" aria-current="page" class="router-link-exact-active router-link-active"><img src="/images/home.png?cecc5a0042910280423fb6ea533164b8" alt="" style="width: 30px;"></a></div>

            </div>
            <div class="row">
                <div class="col-md-12 fani_bg">

                </div>
            </div>  

            <div class="row">
                <div class="col-md-12">
                <!-- موفقیت در عملیات -->
                    @if($status == '200') 
                        <div class="row p-3">
                            <div class="col-md-1"></div>
                            <div class="col-md-10 p-2" style="background: #C1FBA4;border-radius:10px;text-align:center">
                                <p style="font-size:18px">پرداخت با موفقیت انجام شد</p>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>کد پیگیری تراکنش : {{$code}}</p>
                                    </div>
                                </div>
                                <div class="row" style="text-align: center;">
                                    <div class="col-md-6 p-3">
                                        {{Auth::user()->code_meli}} : کد ملی 
                                    </div>
                                    <div class="col-md-6 p-3">
                                     نام کاربری  :   {{Auth::user()->name}} 
                                    </div>
                                </div>

                                <div class="row" style="text-align: center;">
                                    <div class="col-md-6 p-3">
                                        مبلغ پرداخت : {{$pay->price/10000}} هزار تومان
                                    </div>
                                    <div class="col-md-6 p-3">
                                     تعداد شارژ جلسه  :   {{$pay->etc2}} جلسه
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/select">
                                        <button class="btn btn-danger">انتقال به برنامه</button>
                                        </a>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12 p-2">
                                        <div style="font-size: 12px;color:gray">بعد از <span id="time">00:10</span> ثانیه به طور اتوماتیک به صفحه اصلی منتقل خواهید شد</div>                                    </div>

                                </div>
                            </div>
                        </div>

                    <!-- شکست در عملیات -->
                    @else
                        <div class="row p-3">
                                <div class="col-md-1"></div>
                                <div class="col-md-10 p-2" style="background:#EA8592;border-radius:10px;text-align:center">
                                    <p style="font-size:18px">خطا در تراکنش</p>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p>کد پیگیری خطا تراکنش : {{$id->id}}</p>
                                        </div>
                                    </div>
                                    <div class="row" style="text-align: center;">
                                        <div class="col-md-6 p-3">
                                            {{$user->code_meli}} : کد ملی 
                                        </div>
                                        <div class="col-md-6 p-3">
                                        نام کاربری  :   {{$user->name}} 
                                        </div>
                                    </div>

                                    <div class="row" style="text-align: center;">
                                        <div class="col-md-6 p-3">
                                            مبلغ پرداخت : {{$id->price/10000}} هزار تومان
                                        </div>
                                        <div class="col-md-6 p-3">
                                        تعداد شارژ جلسه  :   {{$id->etc2}} جلسه
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button onclick="location.replace('/select')" class="btn btn-danger">انتقال به برنامه</button>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-12 p-2">
                                            <div style="font-size: 12px;color:gray">بعد از <span id="time">00:10</span> ثانیه به طور اتوماتیک به صفحه اصلی منتقل خواهید شد</div>                                    </div>

                                    </div>
                                </div>
                            </div>

                    @endif
                </div>
            </div>
        </div>

    </body>

    <script>
            function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    location.replace("/select")
                }
            }, 1000);
        }

        window.onload = function () {
            var fiveMinutes = 10,
                display = document.querySelector('#time');
            startTimer(fiveMinutes, display);
        };
    </script>
</html>
