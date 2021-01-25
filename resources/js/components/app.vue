<template>
    <div class="container-fluid p-0" data-app>

        <div class="sticky_navbar" id="sticky_navbar">
            <div class="row">
                <div class="col-md-3 col-3" style="text-align:right;padding-right:28px">
                    <router-link to="/">
                        <img src="./img/home.png" style="width:30px;" alt="">
                    </router-link>
                </div>
                
                 <div class="col-md-6 col-6 pt-3 pl-1 pr-1" style="text-align:center">
                    <p style="color:white">آکادمی تیراندازی دانشکده فنی</p>
                </div>
                
                <div v-if="this.login > 2" class="col-md-3 col-3" @click="click_onmanu" style="text-align:left;padding-left:25px;">
                    <img src="./img/menumobile.png" style="width:30px;" alt="">
                </div>

                <div v-if="this.login < 3" class="col-md-3 col-3"  style="text-align:left;padding-left:25px;">
                    <img src="./img/menumobile.png" style="width:30px;filter: grayscale(100%);" alt="">
                </div>
               

            </div>
        </div>  

    <v-navigation-drawer
      v-model="drawer"
      absolute
      left
      temporary
    >
      <v-list
        nav
        dense
      >
        <v-list-item-group
          v-model="group"
          active-class="deep-purple--text text--accent-4"
        >
            <v-list-item>

                <v-list-item-title> 
                <div style="text-align:center">
                <img v-bind:src="this.user.scan_pic" style="width:50%;border-radius:40%;margin-bottom:10px" alt="">
                </div>
                <p>{{this.user.name}}</p>
                <p> کد کاربری : {{this.user.code_meli}} </p>
                <p> شماره تلفن : {{this.user.phone}}</p>
                <hr class="hr">
                </v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>پروفایل کاربری </v-list-item-title>
          </v-list-item>

            <router-link to="List_reserve">
                <v-list-item>
                    <v-list-item-title>گزارش عملکرد</v-list-item-title>
                </v-list-item>
            </router-link>

            <router-link to="List_payment">
                <v-list-item >
                    <v-list-item-title>گزارش پرداختی</v-list-item-title>
                </v-list-item>
            </router-link>

            <a  v-if="this.user.etc === '1'" href="/couch/c_list_student">
                <v-list-item>
                    
                    <v-list-item-title> پنل مربی</v-list-item-title>
                    
                </v-list-item>
            </a>
          <v-list-item>
              
            <v-list-item-title v-on:click="logout">خروج</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>


       <div class="row login_noti_header" v-if="this.login == 0">
           <div class="col-md-2 col-1"></div>
           <div class="col-md-8 col-10 not_register_box">
                <p>برای استفاده از تمام امکانات ابتدا ثبت نام کنید</p>
                <router-link to="/login">
                    <span style="color:white">ورود به سامانه </span>
                </router-link>
                    /
                <router-link to="/signup">
                    <span style="color:white">ثبت نام</span>
                </router-link> 
           </div>
           
       </div>

       <div class="row login_noti_verify_header" v-if="this.login == 1">
           <div class="col-md-12">
                <p>{{this.user.name}} عزیز به سایت خوش آمدید</p>
                <p>برای استفاده کامل از برنامه می باشد تایید هویت انجام دهید</p>
                
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
            <div class="col-md-1 col-1"></div>
            <div class="col-md-10 col-10">
                <div class="row login_box_light_ok">
                    <div class="col-md-2 col-4">
                            
                        <img :src="this.user.scan_pic" style="border-radius:50%;padding:3px" width="100px" alt="">
                    </div>

                    <div class="col-md-10 col-8 mt-2 pt-3">
                        <p style="color:white;margin-bottom:15px">{{this.user.name}}
                            <span v-if="this.user.etc === '1'" style="font-size:12px;padding:10px"><a href="/couch/c_list_student"> پنل مربی </a></span>
                        </p>

                        <p style="font-size:10px;color:white;margin-bottom:5px">کد ملی : {{this.user.code_meli}}</p>

                    </div>
                </div>
            </div>
            
        </div>

       
           <div class="box_header_white" v-if="this.login === 3">
               <div class="row" style="text-align:center">
                   <div class="col-md-4 col-4"  @click="get_exerice">
                       <img src="./img/t1.png" width="30px" alt="">
                       <p class="p_in_box_header_white">تمرین</p>
                   </div>
                   <div class="col-md-4 col-4" @click="get_exerice_solve">
                       <img src="./img/t3.png" width="40px" alt="">
                        <p class="p_in_box_header_white">تحلیل تمرین</p>
                   </div>
                   <div class="col-md-4 col-4" @click="skat">
                       <img src="./img/t2.png" width="40px" alt="">
                        <p class="p_in_box_header_white" style="padding-top:4px">تحلیل اسکت</p>
                   </div>
               </div>
           </div>
        <br/>
        <br/>

        <router-view :user_data="user"></router-view>

        <!-- تمرین ها  -->
        <v-bottom-sheet v-model="sheet">
            <v-sheet
                class="text-center"
                height="400px"
            >
                <v-btn
                class="mt-6"
                text
                color="red"
                @click="sheet = !sheet"
                >
                close
                </v-btn>
                <div class="py-3" style="text-align:center">
                    <div style="overflow-y:auto">
                    <table style="width:90%;margin-right:5%;">
                    <thead>
                        <tr>
                        <th class="tb_exerxise">
                            کد 
                        </th>
                        <th class="tb_exerxise">
                            تاریخ تمرین
                        </th>
                        <th class="tb_exerxise">
                            فایل تمرین
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="item in this.exercise_data"
                        :key="item.id"
                        >
                        <td class="tbl_exercise_td">{{ item.id }}</td>
                        <td class="tbl_exercise_td" style="font-size:13px">{{ item.time }}</td>
                        <td class="tbl_exercise_td" style="font-size:13px"><a :href="item.file">دانلود</a></td>
                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </v-sheet>
        </v-bottom-sheet>


        <v-bottom-sheet v-model="sheet2">
            <v-sheet
                class="text-center"
                height="400px"
            >
                <v-btn
                class="mt-6"
                text
                color="red"
                @click="sheet2 = !sheet2"
                >
                close
                </v-btn>
                <div class="py-3" style="text-align:center">
                    <div style="overflow-y:auto">
                    <table style="width:90%;margin-right:5%;">
                    <thead>
                        <tr>
                        <th class="tb_exerxise">
                            کد تمرین
                        </th>
                        <th class="tb_exerxise">
                            تحلیل تمرین
                        </th>
                        <th class="tb_exerxise">
                            فایل تحلیل
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="item in this.exercise_data2"
                        :key="item.id"
                        >
                        <td class="tbl_exercise_td">{{ item.exercise_files_id }}</td>
                        <td class="tbl_exercise_td"  style="font-size:13px">{{item.comment}}</td>
                        <td class="tbl_exercise_td"  style="font-size:13px"><a :href="item.file">دانلود</a></td>

                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </v-sheet>
        </v-bottom-sheet>

        <v-bottom-sheet v-model="sheet3">
            <v-sheet
                class="text-center"
                height="400px"
            >
                <v-btn
                class="mt-6"
                text
                color="red"
                @click="sheet3 = !sheet3"
                >
                close
                </v-btn>
                <div class="py-3" style="text-align:center">
                    <div style="overflow-y:auto">
                    <table style="width:90%;margin-right:5%;">
                    <thead>
                        <tr>
                        <th class="tb_exerxise">
                            تاریخ
                        </th>
                        <th class="tb_exerxise">
                            کامنت اسکت
                        </th>
                        <th class="tb_exerxise">
                            فایل اسکت
                        </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="item in this.exercise_data3"
                        :key="item.id"
                        >
                        <td class="tbl_exercise_td" style="font-size:10px">{{ item.time }}</td>
                        <td class="tbl_exercise_td"  style="font-size:13px">{{item.comment}}</td>
                        <td class="tbl_exercise_td"  style="font-size:13px"><a :href="item.file">دانلود</a></td>

                        </tr>
                    </tbody>
                    </table>
                    </div>
                </div>
            </v-sheet>
        </v-bottom-sheet>
    </div>
</template>

<script>
import Axios from 'axios'
    export default {
        data: () => ({
            model: null,
            login : null,
            user : [],
            sheet: false,
            exercise_data : [],

            sheet2: false,
            exercise_data2 : [],
            
            sheet3: false,
            exercise_data3 : [],

            drawer: false,
            group: null,
        }),
        watch:{
            '$route': 'checklogin_ff',
            
            group () {
            this.drawer = false
      },
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
            },
            get_exerice:function(){
                Axios.get('/api/get_exercise_data')
                .then((res)=>{
                    if(res.data.status === '200'){
                        this.exercise_data = res.data.data
                        this.sheet = true
                    }
                })
            },
            get_exerice_solve:function(){
                 Axios.get('/api/get_exercise_solve_data')
                .then((res)=>{
                    if(res.data.status === '200'){
                        this.exercise_data2 = res.data.data
                        this.sheet2 = true
                    }
                })
            },
            skat:function(){
                 Axios.get('/api/get_skat')
                .then((res)=>{
                    if(res.data.status === '200'){
                        this.exercise_data3 = res.data.data
                        this.sheet3 = true
                    }
                })
            },
            click_onmanu:function(){
                window.scrollTo(0,0);
                this.drawer = !this.drawer
            },

            logout:function(){
                Axios.get('/api/logoutpanel')
                .then((res)=>{
                    if(res.data.status === '200'){
                        setTimeout(() => {
                            window.location.replace('/')
                        }, 1000);
                    }else{

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
