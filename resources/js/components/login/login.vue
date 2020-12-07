<template>
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
                                <p>لطفا برای ورود اطلاعات خود را کامل وارد کنید</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="codemeli"> کد ملی :</label>
                                <input v-model="code_mali" type="text" @keypress="isNumber($event)" class="form-control" name="codemeli">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="password"> پسورد :</label>
                                <input v-model="password" type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <button @click="login" class="btn btn-success pr-5 pl-5" style="border-radius:20px;box-shadow: 5px 4px 20px 1px #999999;" >ورود به سامانه</button>
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
import './login.css'
export default {
    data : () =>({
        code_mali : '',
        password : '',

        snackbar: false,
        text: '',
        timeout: 2000,
        btn_status : 1
    }),
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
    methods:{
        login:function(){
            if(this.code_mali.length < 8){
                this.text = 'لطفا فیلد کد ملی را کامل پر کنید'
                this.snackbar = true
            }else if(this.password.length < 5){
                this.text = 'لطفا فیلد پسورد را کامل پر کنید'
                this.snackbar = true
            }else if(this.password.length > 50){
                this.text = 'حداکثر عبارت مجاز پسورد 50 کاراکتر میباشد'
                this.snackbar = true
            }else{
                Axios.post('/api/login',
                {
                    data : {'code_meli' : this.code_mali , 'password' : this.password}
                }).then((res)=>{
                    if(res.data.status === '300'){
                        this.text = ' کاربری با این کد ملی در برنامه وجود ندارد'
                        this.snackbar = true 
                    }else if(res.data.status === '302'){
                        this.text = 'پسورد را اشتباه وارد کرده اید'
                        this.snackbar = true 
                    }else if(res.data.status === '200'){
                        this.text = 'ورود موفقیت آمیز'
                        this.snackbar = true 
                        setTimeout(() => {
                            this.$router.replace('/')
                        }, 500);
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
    },
    watch:{
        code_mali:function(){
            if(this.code_mali.length > 12){
                this.code_mali = this.code_mali.slice(0,12)
            }
        },
    }
}
</script>