<template>
    <div>

        <div v-if="this.model > 0" class="caclculate_sticky">
                <p class="name_cal_sticky">{{this.items[model].text}}</p>

                <p class="price_cal_sticky">{{this.items[model].price}} تومان</p>

                <p class="payment_cal_sticky">پرداخت</p>
          </div>

        <div v-if="this.count > 0" class="caclculate_sticky_2">
                <p class="name_cal_sticky">تعداد جلسات : {{this.count}} </p>

                <p class="price_cal_sticky"> {{this.count * this.base_price}} تومان</p>

                <p class="payment_cal_sticky">پرداخت</p>
          </div>

        <div class="row mt-3">
            <div class="col-md-6 col-12 p-4 mb-3">
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
                                    {{item.price}}  تومان
                                </div>
                            </v-list-item>
                        </v-list-item-group>
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
                                        {{this.count}}
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

            <br/>
            <br/>
        </div>
    </div>

</template>

<script>
import './reserve.css'
export default {
     data: () => ({
      items: [
        {
            text: 'انتخاب بسته ها',
            icon:'./../images/334.png',
            price: 0
        },
        {
            text: 'شارژ 10 جلسه ای ',
            icon:'./../images/boronze.png',
            price: 350000
        },
        {
            text: 'شارژ 20 جلسه ای',
            icon:'./../images/silver.png',
            price: 700000

        },
        {
            text: 'شارژ 30 جلسه ای',
            icon:'./../images/gold.png',
            price: 900000

        },
      ],
      model: 0,
      base_price : 35000,
      count : 0
    }),
    watch :{
        count : function(){
            if(this.count > 0 ){
                this.model = 0
            }
        },
        model : function(){
            if(this.model > 0){
                this.count = 0
            }
        }
    }
}

</script>