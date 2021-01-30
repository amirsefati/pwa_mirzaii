<template>
    <div>
        
       <div class="row">
           <div class="col-md-1 col-1 p-0"></div>
           <div class="col-md-10 col-10 p-0">
               <router-link to="news_noti">
               <p style="font-size:20px">اخبار و اطلاعیه ها</p></router-link>
               <ul style="padding:5px">
                   <li v-for="item in news" :key="item.id">
                       <a v-bind:href="'/news/allnews/'+item.id">
                       <p id="glow" style="font-size:12px;margin:2px">{{item.title}}</p>
                       </a>
                    </li>
               </ul>
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
import Axios from 'axios'
export default {
    props: ["user_data"],
    data:()=>({
        news : []
    }),
    created(){
        Axios.get('/api/get_new_home')
        .then((res)=>{
            if(res.data.status === '200'){
                this.news = res.data.news
            }
        })
    }
}
</script>