<template>
    <div>

        <div v-if="this.model > 0" class="caclculate_sticky" @click="pay_go_ml">
                <p class="name_cal_sticky">{{this.items[model].text}}</p>

                <p class="price_cal_sticky">{{ ((this.items[model].price - this.off_amount)/1000  ) > 0 ? (this.items[model].price - this.off_amount)/1000 : (this.items[model].price)/1000}} هزار تومان </p>

                <p class="payment_cal_sticky">پرداخت</p>
                <div style="display:none">
                {{this.price = this.items[model].price}}
                </div>
          </div>

        <div v-if="this.count > 0" class="caclculate_sticky_2" @click="pay_go_ml">
                <p class="name_cal_sticky">تعداد جلسات : {{this.count}} </p>

                <p class="price_cal_sticky"> {{(((this.count * this.base_price) - this.off_amount)/1000 > 0) ? (((this.count * this.base_price) - this.off_amount)/1000)  : ((this.count * this.base_price)/1000 )}} هزار تومان</p>

                <p class="payment_cal_sticky">پرداخت</p>
                <div style="display:none">
                {{this.price = (((this.count * this.base_price) - this.off_amount)) > 0 ? ((this.count * this.base_price) - this.off_amount) : (this.count * this.base_price)}}
                </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 col-12 p-4">
                <v-card
                    class=""
                    max-width="600"
                    >
                        <div class="pt-3 pr-3">
                            <span style="font-size:20px;font-weigth:bold;margin-bottom:1px">
                                
                                بسته های  شارژ :</span>
                        </div>
                        <hr>
                        <v-list>
                        <v-list-item-group
                            v-model="model"
                            mandatory
                            color="indigo"
                        >
                            <v-list-item
                                v-for="(item, i) in items"
                                :key="i"
                                >
                                <v-list-item-icon>
                                    <img :src="item.icon" width="45px" alt="">
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title style="font-size:19px;padding:10px" v-text="item.text"></v-list-item-title>
                                </v-list-item-content>

                                <div v-if="item.price > 10000">
                                    <p style="color:#9A031E;font-size:10px;margin:3px;text-decoration: line-through">{{item.no_off}}  تومان</p>
                                    <p style="color:green">{{item.price}}  تومان</p>
                               </div>
                            </v-list-item>
                        </v-list-item-group>
                        <br>
                        </v-list>
                </v-card>
            </div>

            <div class="col-md-6 col-12 p-4 mb-5">
                <v-card
                    class="mb-3"
                    max-width="500"
                    >
                        <div class="p-3">
                            <p style="font-size:20px;font-weigth:bold;margin-bottom:1px"> خرید جلسه :</p>
                        </div>
                        <hr>

                        <div class="row" style="text-align:center">
                            <div class="col-md-6 col-6">
                                قیمت پایه هر جلسه 
                            </div>

                            <div class="col-md-6 col-6">
                                {{this.base_price}} تومان
                            </div>
                        </div>

                        <div class="row" style="text-align:center">
                            <div class="col-md-6 col-6">
                                تعداد جلسات
                            </div>

                            <div class="col-md-6 col-6">
                                <div>
                                    <button class="btn btn-success" @click="count < 9 ? count ++ : count">+</button>
                                        <span style="padding:4px">{{this.count}}</span>
                                    <button class="btn btn-danger" @click="count > 0 ? count -- : count">-</button>
                                </div>
                            </div>

                        </div>

                        

                        <div class="row" style="text-align:center">
                            <div class="col-md-6 col-6">
                                قیمت نهایی
                            </div>

                            <div class="col-md-6 col-6">
                                <div>
                                    {{ this.count * this.base_price}}
                                </div>
                            </div>

                        </div>
                </v-card>
            </div>


            <div v-if="this.user_data.kind === '4'" class="col-md-6 col-12 p-4 mb-5" style="margin-top:-40px">
                <v-card
                    class="mb-3"
                    max-width="500"
                    >
                        <div class="p-3">
                            <p style="font-size:20px;font-weigth:bold;margin-bottom:1px"> اعمال کد تخفیف  :</p>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-4 col-4 pt-3" style="text-align:center">کد تخفیف : </div>
                            <div class="col-md-8 col-7">
                                <input :readonly="this.off_amount > 0" type="text" class="form-control" v-model="off_code">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" style="text-align:center">
                                <button :disabled="this.off_amount > 0" @click="check_off" class="btn btn-success"> بررسی کد </button>
                            </div>
                        </div>
                    
                </v-card>
            </div>

            <br/>
            <br/>
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
import './reserve.css'
export default {
    created(){
        Axios.get('/api/get_price_by_userlevel')
        .then((res)=>{
            this.base_price = res.data.base_price * res.data.off
            this.items[1].price = res.data.base_price * 10 * res.data.off * res.data.off_10
            this.items[1].no_off = res.data.base_price * 10 * res.data.off

            this.items[2].price = res.data.base_price * 20 * res.data.off * res.data.off_20
            this.items[2].no_off = res.data.base_price * 20 * res.data.off

            this.items[3].price = res.data.base_price * 30 * res.data.off * res.data.off_30
            this.items[3].no_off = res.data.base_price * 30 * res.data.off

            this.off_10 = res.data.off_10
            this.off_20 = res.data.off_20
            this.off_30 = res.data.off_30
            this.off = res.data.off

        })
    },
    props: ["user_data"],
     data: () => ({
        base_price : 0,

        off_10 : 0,
        off_20 : 0,
        off_30 : 0,
        off : 0,

        items: [
            {
                text: 'انتخاب بسته ها',
                icon:'./../images/334.png',
                price: 0,
                no_off:0,
                package : 'c0'
            },
            {
                text: 'شارژ 10 جلسه ای ',
                icon:'./../images/boronze.png',
                price: 0,
                no_off:0,
                package : '10'

            },
            {
                text: 'شارژ 20 جلسه ای',
                icon:'./../images/silver.png',
                price: 0,
                no_off:0,
                package : '20'
            },
            {
                text: 'شارژ 30 جلسه ای',
                icon:'./../images/gold.png',
                price: 0,
                no_off:0,
                package : '30'
            },
        ],
        model: 0,
        count : 0,
        price : 0,
        off_code : ' ',
        package: '',
        
        snackbar: false,
        text: '',
        timeout: 2000,
        delay:1,
        off_amount:0
    }),
    watch :{
        count : function(){
            if(this.count > 0 ){
                this.model = 0
                this.package = this.count
            }
        },
        model : function(){
            if(this.model > 0){
                this.count = 0
                this.package = this.items[this.model].package
            }
        }
    },
    methods:{
        pay_go_ml:function(){
            Axios.post('/api/pay_go_ml',{
                data:{'amount':this.price,'package':this.package}}
            ).then((res)=>{
                if(res.data.status === '200'){
                    var url = '/api/gotopay/' + res.data.refid
                    window.location.replace(url)
                }else{
                    alert('خطا در اتصال به درگاه')
                }
               
            })
        },
        check_off:function(){
            if(this.off_code === ' '){

            }else{
                if(this.delay === 1) {
                this.delay = 0
                setTimeout(() => {
                    this.delay = 1
                }, 1500);

                Axios.post('/api/verify_offcode',{
                data : {'off_code':this.off_code}
                }).then((res)=>{
                    if(res.data.status === '300'){
                            this.text = 'چنین کد تخفیفی یافت نشد'
                            this.snackbar = true
                    }else if(res.data.status === '301'){
                        this.text = 'قبلا این کد توسط شما ثبت شده است'
                        this.snackbar = true
                    }
                    else if(res.data.status === '302'){
                        this.text = 'این کد منقضی شده است'
                        this.snackbar = true
                    }else if(res.data.status === '200'){
                        this.text = 'کد تخفیف اعمال شد'
                        this.snackbar = true
                        this.off_amount = res.data.off_amount
                    }
                })
                }else{
                this.text = 'لطفا تا پردازش کامل صبر کنید'
                this.snackbar = true
            }
            }
        }
    }
}

</script>