<template>
    <div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="row box_verify p-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="name">نام و نام خانوادگی :</label>
                                <input type="text" class="form-control" name="name" v-model="this.name">
                            </div>

                            <div class="col-md-3">
                                <label for="name"> کد ملی:</label>
                                <input type="text" class="form-control" name="code_meli" v-model="this.code_meli">
                            </div>

                            <div class="col-md-3">
                                <label for="name"> شماره تلفن :</label>
                                <input type="text" class="form-control" name="phone" v-model="this.phone">
                            </div>

                            <div class="col-md-3">
                                <label for="name"> ایمیل :</label>
                                <input type="text" class="form-control" name="email" v-model="this.email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="has_gun"> وضعیت مالکیت اَسلحه :</label>
                                <select name="has_gun"  v-model="has_gun" class="form-control" id="">
                                    <option value="0">اسلحه ندارم</option>
                                    <option value="1">اسلحه دارم</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="kind"> نوع کاربری :</label>
                                <select name="kind"  v-model="kind" class="form-control" id="">
                                    <option value="0">دانشجوی دانشکده فنی</option>
                                    <option value="1">دانشجوی غیر دانشکده فنی</option>
                                    <option value="2">اساتید و کارکنان دانشکده فنی</option>
                                    <option value="3">اساتید و کارکنان غیر دانشکده فنی</option>
                                    <option value="4">عادی</option>

                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4" style="padding:10px">
                                <div class="box_upload p-3">
                                    <label for="scan_shenasname"> اسکن  کارت ملی :</label>
                                    <input type="file" @change="onFileChange" ref="sc1"/>

                                    <img v-if="url1" :src="url1" width="100%" alt="">
                                </div>
                            </div>

                            <div class="col-md-4" style="padding:10px">
                                <div class="box_upload p-3">
                                    <label for="scan_shenasname"> اسکن  عکس پرسنلی :</label>
                                    <input type="file" @change="onFileChange2" ref="sc2"/>

                                    <img v-if="url2" :src="url2" width="100%" alt="">
                                </div>
                            </div>

                            <div class="col-md-4" style="padding:10px">
                                <div class="box_upload p-3">
                                    <label for="scan_shenasname"> اسکن بیمه ورزشی :</label>
                                    <input type="file" @change="onFileChange3" ref="sc3"/>

                                    <img v-if="url3" :src="url3" width="100%" alt="">

                                    <a href="https://insurance.ifsm.ir/UserOnline/Login" style="font-size:9px;position:absolute;bottom:15px;left:20px">برای ثبت نام بیمه ورزشی روی لینک کلیک کنید</a>
                                </div>
                            </div>

                            <div v-if="this.kind < 2" class="col-md-4" style="padding:10px">
                                <div class="box_upload p-3">
                                    <label for="scan_card_student"> کارت دانشجویی :</label>
                                    <input type="file" @change="onFileChange4" ref="sc4"/>

                                    <img v-if="url4" :src="url4" width="100%" alt="">
                                </div>
                            </div>

                            <div v-if="this.kind < 4 && this.kind > 1" class="col-md-4" style="padding:10px">
                                <div class="box_upload p-3">
                                    <label for="scan_card_student"> کارت شناسایی کارمندان و اساتید  :</label>
                                    <input type="file" @change="onFileChange5" ref="sc5"/>

                                    <img v-if="url5" :src="url5" width="100%" alt="">
                                </div>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12" style="text-align:center">
                                <button @click="send_data" class="btn btn-success pl-5 pr-5">ارسال اطلاعات</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <v-snackbar
            v-model="snackbar"
            :timeout="timeout"
            >
            {{ text }}

            <template v-slot:action="{ attrs }">
                <v-btn
                color="blue"
                text
                v-bind="attrs"
                @click="snackbar = false"
                >
                بستن
                </v-btn>
            </template>
        </v-snackbar>

    </div>

    
</template>



<script>
import './verify.css'
import Axios from 'axios'

export default {
    data:()=>({
        id : '',
        name : '',
        phone : '',
        email : '',
        code_meli : '',
        has_gun : 0,
        kind : 0,
        rules: [
            value => !value || value.size < 6000000 || 'حداکثر حجم فایل زیر 6 مگابایت',
        ],
        url1 : '',
        url2 : '',
        url3 : '',
        url4 : '',
        url5 : '',

        file : '',
        file1 : '',
        file2 : '',
        file3 : '',
        file4 : '',
        file5 : '',

        snackbar: false,
        text: '',
        timeout: 2000,
        btn_status : 1

    }),
    created(){
        Axios.get('/api/checklogin')
            .then((res)=>{
                if(res.data.status === '200'){
                    if(res.data.user.status === '1'){
                        this.id = res.data.user.id
                        this.name = res.data.user.name
                        this.phone = res.data.user.phone
                        this.email = res.data.user.email
                        this.code_meli = res.data.user.code_meli

                    }
                    else{
                        this.$router.replace('/')
                    }
                }
                else{
                    this.$router.replace('/')
                }

            })
    },
    methods: {
        onFileChange(e) {
        this.file = e.target.files[0];
        this.url1 = URL.createObjectURL(this.file);
        },

        onFileChange2(e) {
        this.file2 = e.target.files[0];
        this.url2 = URL.createObjectURL(this.file2);
        },

        onFileChange3(e) {
        this.file3 = e.target.files[0];
        this.url3 = URL.createObjectURL(this.file3);
        },

        onFileChange4(e) {
        this.file4 = e.target.files[0];
        this.url4 = URL.createObjectURL(this.file4);
        },

        onFileChange5(e) {
        this.file5 = e.target.files[0];
        this.url5 = URL.createObjectURL(this.file5);
        },
        send_data:function(){

            if(this.file.length < 5){
                this.text = 'لطفا اسکن کارت ملی را وارد کنید'
                this.snackbar = true
            }else if(this.file2.length < 5){
                this.text = 'لطفا عکس پرسنلی خود وارد وارد کنید'
                this.snackbar = true
            }else if(this.file3.length < 5){
                this.text = 'لطف اسکن بیمه ورزشی را وارد کنید'
                this.snackbar = true
            }else{

            let formdata = new FormData()

            formdata.append('fl1',this.file)
            formdata.append('fl2',this.file2)
            formdata.append('fl3',this.file3)
            formdata.append('fl4',this.file4)
            formdata.append('fl5',this.file5)

            formdata.append('name',this.name)
            formdata.append('phone',this.phone)
            formdata.append('email',this.email)
            formdata.append('code_meli',this.code_meli)
            formdata.append('has_gun',this.has_gun)
            formdata.append('id',this.id)
            formdata.append('kind',this.kind)

            Axios.post('/api/upload_img_v',formdata,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then((res)=>{
                if(res.data.status === '200'){
                    this.$router.replace('/')
                }else{
                    console.log(res)
                    alert('اطلاعات شما با فرد دیگری یکسان است لطفا با مدیریت تماس بگیرید')
                }
            })
        }
        }
  }
}
</script>