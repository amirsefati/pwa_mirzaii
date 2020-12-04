<template>
    <div class="container-fluid p-0" data-app>

        <div class="sticky_navbar" id="sticky_navbar">
            <div class="row">
                <div class="col-md-4 col-4" style="text-align:right;padding-right:25px;">
                    <img src="./img/menumobile.png" style="width:30px;" alt="">
                </div>
                <div class="col-md-4 col-4" style="text-align:center"></div>
                <div class="col-md-4 col-4" style="text-align:left;padding-left:28px">
                    <router-link to="/">
                        <img src="./img/home.png" style="width:30px;" alt="">
                    </router-link>

                </div>

            </div>
        </div>  

       <div class="row login_noti_header" v-if="this.login == 0">
           <div class="col-md-12">
                <p>برای استفاده از تمام امکانات سایت لازم هست که ابتدا ثبت نام کنید</p>
                <router-link to="/login">
                    <span>ورود به سایت </span>
                </router-link>
                    /
                <router-link to="/signup">
                ثبت نام
                </router-link> 
           </div>
           
       </div>

       <div class="row login_noti_verify_header" v-if="this.login == 1">
           <div class="col-md-12">
                <p>{{this.user.name}} عزیز به سایت خوش آمدید</p>
                <p>برای استفاده کامل از سایت می باشد تایید هویت انجام دهید</p>
                
                <router-link to="/verify">
                 <button class="btn btn-danger">ورود به بخش احراز هویت</button>
                </router-link> 
           </div>
       </div>

       <div class="row login_noti_verify_header" v-if="this.login == 2">
           <div class="col-md-12">
                <p>{{this.user.name}} عزیز به سایت خوش آمدید</p>
                <p>اطلاعات شما برای مدیر ارسال شده است </p>
                <p>به محض تایید هویت می توانید از امکانات برنامه استفاده کنید</p>
           </div>
       </div>


        <div class="row app_background_header" v-if="this.login === 3">
           <div class="row pt-2">
               <div class="col-md-2 col-5" style="text-align:center">
                   <img src="./img/profile.png" class="img_profile pt-2" alt="">
               </div>

               <div class="col-md-10 col-7">
                   <div class="row">
                       <div class="col-md-12">
                           <p class="name_profile">{{this.user.name}}</p>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-12 pb-0">
                           <p class="code_meli_profile"> کد ملی : {{this.user.code_meli}}</p>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-12">
                           <p class="code_b_profile"> </p>
                       </div>
                   </div>
               </div>
           </div>
       </div>


       <div class="row app_background_header_clippath" v-if="this.login == 3">

       </div>

        <router-view :user_data="user"></router-view>
    </div>
</template>

<script>
import Axios from 'axios'
    export default {
        data: () => ({
            model: null,
            login : 0,
            user : []
        }),
        watch:{
            '$route': 'checklogin_ff'
        },
        methods:{
            checklogin_ff:function(){
                Axios.get('/api/checklogin')
                .then((res)=>{
                    if(res.data.status === '200'){

                        this.user = res.data.user
                        if(res.data.user.status === '1'){
                            // sign up not verify
                          this.login = 1
                        }
                        else if(res.data.user.status === '2'){
                            //wait for verify
                          this.login = 2 
                        }
                        else if(res.data.user.status === '3'){
                            //verified
                          this.login = 3  
                        }
                    }
                    else if(res.data.status === '301'){
                        //not signup
                        this.login = 0

                    }else{
                        alert('خطا پیش آمده است')
                    }
                })
            }
        },
        created(){
            Axios.get('/api/checklogin')
            .then((res)=>{
                if(res.data.status === '200'){
                    this.user = res.data.user
                        if(res.data.user.status === '1'){
                            // sign up not verify
                          this.login = 1
                        }
                        else if(res.data.user.status === '2'){
                            //wait for verify
                          this.login = 2 
                        }
                        else if(res.data.user.status === '3'){
                            //verified
                          this.login = 3  
                    }
                }
                else if(res.data.status === '301'){
                    this.login = 0
                }else{
                    alert('خطا پیش آمده است')
                }
            })
        },
    
  }
</script>
