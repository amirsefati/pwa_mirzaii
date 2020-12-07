<template>
    <div>    
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 p-4">
                        <div class="login_box">
                            <div class="row">
                                <div class="col-md-4 col-4" style="text-align:center">
                                    <img src="./../img/logo_tehran.png" width="60px" alt="">
                                </div>
                                <div class="col-md-4 col-4" style="text-align:center">
                                    
                                </div>
                                <div class="col-md-4 col-4" style="text-align:center">
                                    <img src="./../img/fani_t.png" width="80px" alt="">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="text-align:center">
                                    <p>لطفا برای ثبت نام اطلاعات خود را کامل وارد کنید</p>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="name">نام و نام خانوادگی: </label>
                                    <input type="text" class="form-control" v-model="name">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="born">تاریخ تولد :</label>
                                    <input type="text" class="form-control" v-model="born">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="codemali">کد ملی :</label>
                                    <input type="text" @keypress="isNumber($event)" class="form-control" v-model="code_meli">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tel"> شماره تلفن :</label>
                                    <input type="text" @keypress="isNumber($event)" class="form-control" v-model="tel">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="email"> ایمیل کاربری :</label>
                                    <input type="email" class="form-control" v-model="email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="password">  پسورد :</label>
                                    <input type="password" class="form-control" v-model="password">
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12" style="text-align:center">
                                    <button v-on:click="signup_m" :disabled="btn_status == 0" class="btn btn-success pr-5 pl-5" style="border-radius:20px;box-shadow: 5px 4px 20px 1px #999999;" >ورود به سامانه</button>
                                </div>
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
import Axios from 'axios'
import './signup.css'
export default {
    created(){
        Axios.get('/api/checklogin')
            .then((res)=>{
                if(res.data.status === '200'){
                    this.$router.replace('/')
                }
                else if(res.data.status === '301'){

                }else{
                    alert('خطا پیش آمده است')
                }
            })
    },
    data:()=>({
        name: '',
        born: '',
        code_meli: '',
        tel: '',
        email: '',
        password: '',

        snackbar: false,
        text: '',
        timeout: 2000,
        btn_status : 1

    }),
    methods:{
        signup_m:function(){
            if(this.name.length < 4){
                this.text = 'لطفا نام خود را به شکل صحیح وارد کنید'
                this.snackbar = true
            }else if(this.code_meli.length < 10){
                this.text = 'لطفا کد ملی خود را به شکل صحیح وارد کنید'
                this.snackbar = true
            }else if(this.tel.length < 8){
                this.text = 'لطفا تلفن خود را به شکل صحیح وارد کنید'
                this.snackbar = true
            }else if(this.email.length < 5){
                this.text = 'لطفا ایمیل خود را به شکل صحیح وارد کنید'
                this.snackbar = true
            }else if(this.password.length < 6){
                this.text = 'حداقل پسورد 6 کاراکتر می باشد'
                this.snackbar = true
            }else{
                this.btn_status = 0
                Axios.post('/api/register_attempt',{
                    data : {'name':this.name,'born':this.born,'code_meli':this.code_meli,'tel':this.tel,'email':this.email,'password':this.password}
                }).then((res)=>{
                    if(res.data.status === '300'){
                        this.text = res.data.err
                        this.snackbar = true
                        this.btn_status = 1
                    }else if(res.data.status === '200'){
                        this.text = res.data.err
                        this.snackbar = true
                        setTimeout(() => {
                            this.$router.replace('/')
                        }, 1000);
                    }
                })
            }
        },
        isNumber: function(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
                evt.preventDefault();;
            } else {
                return true;
            }
        }
    }
}
</script>