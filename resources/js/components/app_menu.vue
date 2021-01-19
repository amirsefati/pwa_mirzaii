<template>
    <div>
        
       <div class="row">
           <div class="col-md-12">
               <p class="app_news_title">اخبار و اطلاعیه ها</p>
           </div>
       </div>


        <hr class="hr"/>

        <div class="row pr-3  pl-3 mb-3">
            <div class="col-md-4 col-6">
                <router-link to="/courseb">
                <div class="link_box">
                    <img src="./img/courses.png" width="" class="img_box_link" alt="">

                    <p class="app_link_box_p">دوره ها</p>
                </div>
                </router-link>

            </div>

            <div class="col-md-4 col-6">
                <router-link to="/learning">
                <div class="link_box_2">
                    <img src="./img/learn.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">آموزش</p>
                </div>
                </router-link>
            </div>

            <div class="col-md-4 col-6">
                <router-link to="/competition2">
                <div class="link_box_3">
                    <img src="./img/race.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">مسابقات</p>
                </div>
                </router-link>
            </div>

            <div class="col-md-4 col-6">
                <router-link to="/coach1">
                <div class="link_box_4">
                    <img src="./img/sche.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">برنامه حضور مربیان</p>
                </div>
                </router-link>
            </div>

            <div class="col-md-4 col-6">
                <router-link to="/gallery2">
                <div class="link_box_5">
                    <img src="./img/gallery.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">آلبوم تصاویر</p>
                </div>
                </router-link>

            </div>
                
            <div class="col-md-4 col-6">

                <div class="link_box_6" v-if="user_data.status == 3">
                    <router-link to="/select">
                        <img src="./img/reserve.png" width="" class="img_box_link" alt="">
                        <p class="app_link_box_p">ثبت نام و رزرو خط</p>
                    </router-link>
                </div>

                <div class="link_box_6_lock" v-if="user_data.status < 3">

                    <img src="./img/reserve.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">ثبت نام و رزرو خط</p>
                </div>

                <div class="link_box_6_lock" v-if="user_data.status == null">

                    <img src="./img/reserve.png" width="" class="img_box_link" alt="">
                    <p class="app_link_box_p">ثبت نام و رزرو خط</p>
                </div>
            </div>
        </div>
        <router-link to="/about">
        <div class="button_about_us">
            <p style="padding-top:10px">درباره ما</p>
        </div>
        </router-link>
    </div>
</template>

<script>
export default {
    props: ["user_data"]
}
</script>