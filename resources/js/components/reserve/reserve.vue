<template>

    <div>

        <div class="row">
            <div class="col-md-1 col-1"></div>
            <div class="col-md-10 col-10">
                <v-row justify="center">
                    <v-expansion-panels accordion>
                    <v-expansion-panel
                    >
                        <v-expansion-panel-header>قوانین</v-expansion-panel-header>
                        <v-expansion-panel-content>
                            <p style="padding:5px">
                                - شرایط و قوانین رزرو خط
                                امکان رزرو یا لغو رزرو حداکثر از یک روز قبل امکان پذیر می باشد.
                                <br>
                                - درصورت عدم حضور در زمان رزرو شده و عدم هماهنگی قبلی با مسئول جلسه محاسبه می شود.
                                <br>
                                - حداکثر ظرفیت در هر ساعت ۱۱ نفر می باشد.
                            </p>             
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                    </v-expansion-panels>
                </v-row>
            </div>
        </div>

        <div class="row" style="text-align:center;padding:0px 20px;">
            <div class="col-md-6 col-6" :class="this.gun === '1' ? 'gun_s' : ''">
                  با اسلحه : {{this.creadit_has_gun}} جلسه
            </div>
                
            <div class="col-md-6 col-6" :class="this.gun === '0' ? 'gun_s' : ''">
                  بدون اسلحه : {{this.creadit_no_gun}} جلسه
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row p-3">
                    <div  v-for="day in days" :key="day.id" :style="bg_color(day.id)" class="col-3 br_col" style="text-align:center;padding:5px">
                        <p @click="[select_day(day),select=day.id]"  style="margin-bottom:2px;font-size:13px">{{day.d_j}}</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="row" v-if="this.data_day.toString().length > 5">
            <div class="col-md-12 pr-4 pl-4">
                <div class="row">
                    <div class="col-md-12" style="text-align:center">
                        <p style="font-size:18px">
                        {{this.all_data_day.d_j}}
                        </p>
                    </div>
                </div>
                
                <table  style="width:100%;text-align:center">
                    <tbody>
                        <tr>
                            <th style="width:33%;border:1px solid gray;">ساعت</th>
                            <th style="width:33%;border:1px solid gray;">تعداد رزرو </th>
                            <th style="width:33%;border:1px solid gray;">رزرو</th>

                        </tr>
                        <tr>
                            <td class="td_tb">8 - 9:30</td>
                            <td class="td_tb">{{this.data_day[1].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[1].includes(user_data.id),1,all_data_day.d_j)"><button :class="this.data_day[1].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[1].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">9:30 - 11</td>
                            <td class="td_tb">{{this.data_day[2].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[2].includes(user_data.id),2,all_data_day.d_j)"><button :class="this.data_day[2].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[2].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">11 - 12:30</td>
                            <td class="td_tb">{{this.data_day[3].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[3].includes(user_data.id),3,all_data_day.d_j)"><button :class="this.data_day[3].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[3].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">12:30 - 14</td>
                            <td class="td_tb">{{this.data_day[4].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[4].includes(user_data.id),4,all_data_day.d_j)"><button :class="this.data_day[4].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[4].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">14 - 15:30</td>
                            <td class="td_tb">{{this.data_day[5].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[5].includes(user_data.id),5,all_data_day.d_j)"><button :class="this.data_day[5].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[5].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">15:30 - 17</td>
                            <td class="td_tb">{{this.data_day[6].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[6].includes(user_data.id),6,all_data_day.d_j)"><button :class="this.data_day[6].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[6].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">17 - 18:30</td>
                            <td class="td_tb">{{this.data_day[7].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[7].includes(user_data.id),7,all_data_day.d_j)"><button :class="this.data_day[7].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[7].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">18:30 - 20</td>
                            <td class="td_tb">{{this.data_day[8].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[8].includes(user_data.id),8,all_data_day.d_j)"><button :class="this.data_day[8].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[8].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                        <tr>
                            <td class="td_tb">20 - 21:30</td>
                            <td class="td_tb">{{this.data_day[9].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[9].includes(user_data.id),9,all_data_day.d_j)"><button :class="this.data_day[9].includes(this.user_data.id) ? 'btn btn-danger' : 'btn btn-success'">{{this.data_day[9].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</button></td>
                        </tr>
                    </tbody>
                </table>

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
import './reserve.css'
import Axios from 'axios'
export default {
    props:['user_data'],
    data: ()=> ({
        days : [],
        all_data_day : [],
        data_day : [],
        select : 0,
        user : [],
        creadit_has_gun : 0,
        creadit_no_gun : 0,
        gun : null,
        snackbar: false,
        text: '',
        timeout: 2000,
        delay : 1
}),
    created(){
        Axios.get('/api/getreserve_date')
        .then((res) => {
            this.days = res.data.data
            this.gun = res.data.user.has_gun
            this.creadit_has_gun = res.data.user.creadit_has_gun
            this.creadit_no_gun = res.data.user.creadit_no_gun
        })
    },
    methods:{
        select_day:function(day){
            this.all_data_day = day
            this.data_day = JSON.parse(day.data)
        },
        reserv:function(status,whtime,whdate){
            if(this.delay === 1) {
                this.delay = 0
                setTimeout(() => {
                    this.delay = 1
                }, 1500);

                if(status === false){
                    if(this.gun === '1'){
                        if(this.creadit_has_gun > 0){
                            Axios.post('/api/reserv',{
                                data : {'withgun' : this.creadit_has_gun , 'nogun' : this.creadit_no_gun,'status' : status , 'time' : whtime , 'whdate' : whdate}
                            }).then((res)=>{
                                this.days = res.data.data
                                this.creadit_has_gun = res.data.user.creadit_has_gun
                            }).then(()=>{
                                this.days.map((id)=>{
                                    if(id.id == this.select){
                                        this.all_data_day = id
                                        this.data_day = JSON.parse(id.data)
                                    }
                                })
                            })
                        }else{
                            this.text = 'اعتبار شما صفر می باشد'
                            this.snackbar = true
                        }
                    }else if(this.gun === '0'){
                        if(this.creadit_no_gun > 0){
                            Axios.post('/api/reserv',{
                                data : {'withgun' : this.creadit_has_gun , 'nogun' : this.creadit_no_gun,'status' : status , 'time' : whtime , 'whdate' : whdate}
                            }).then((res)=>{
                                this.days = res.data.data
                                this.creadit_no_gun = res.data.user.creadit_no_gun
                            }).then(()=>{
                                this.days.map((id)=>{
                                    if(id.id == this.select){
                                        this.all_data_day = id
                                        this.data_day = JSON.parse(id.data)
                                    }
                                })
                            })
                        }else{
                            this.text = 'اعتبار شما صفر می باشد'
                            this.snackbar = true
                        }
                    }
                }else{
                    Axios.post('/api/reserv',{
                            data : {'withgun' : this.creadit_has_gun , 'nogun' : this.creadit_no_gun,'status' : status , 'time' : whtime , 'whdate' : whdate}
                        }).then((res)=>{
                            this.days = res.data.data
                            this.creadit_has_gun = res.data.user.creadit_has_gun
                            this.creadit_no_gun = res.data.user.creadit_no_gun

                        }).then(()=>{
                            this.days.map((id)=>{
                                if(id.id == this.select){
                                    this.all_data_day = id
                                    this.data_day = JSON.parse(id.data)
                                }
                            })
                        })
                }
            }else{
                this.text = 'لطفا تا ثبت کامل رزرو قبل صبر کنید'
                this.snackbar = true
            }
        },
        bg_color:function(id){
            if(id === this.select){
                return 'background:#D6D6D6'
            }
        }
    },
    
}
</script>