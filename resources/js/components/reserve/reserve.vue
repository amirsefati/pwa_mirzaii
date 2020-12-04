<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="row p-3">
                    <div  v-for="day in days" :key="day.id" class="col-3 br_col" style="text-align:center;padding:5px">
                        <p @click="[select_day(day),select=day.id]" style="margin-bottom:2px;font-size:13px">{{day.d_j}}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="this.data_day.toString().length > 5">
            <div class="col-md-12 p-4">
                <p>
                {{this.all_data_day.d_j}}
                </p>
                <table  style="width:100%;text-align:center">
                    <tbody>
                        <tr>
                            <th style="width:33%;border:1px solid gray;">ساعت</th>
                            <th style="width:33%;border:1px solid gray;">تعداد رزور</th>
                            <th style="width:33%;border:1px solid gray;">رزرو</th>

                        </tr>
                        <tr>
                            <td class="td_tb">8 - 9:30</td>
                            <td class="td_tb">{{this.data_day[1].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[1].includes(user_data.id),1,all_data_day.d_j)">{{this.data_day[1].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">9:30 - 11</td>
                            <td class="td_tb">{{this.data_day[2].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[2].includes(user_data.id),2,all_data_day.d_j)">{{this.data_day[2].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">11 - 12:30</td>
                            <td class="td_tb">{{this.data_day[3].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[3].includes(user_data.id),3,all_data_day.d_j)">{{this.data_day[3].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">12:30 - 14</td>
                            <td class="td_tb">{{this.data_day[4].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[4].includes(user_data.id),4,all_data_day.d_j)">{{this.data_day[4].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">14 - 15:30</td>
                            <td class="td_tb">{{this.data_day[5].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[5].includes(user_data.id),5,all_data_day.d_j)">{{this.data_day[5].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">15:30 - 17</td>
                            <td class="td_tb">{{this.data_day[6].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[6].includes(user_data.id),6,all_data_day.d_j)">{{this.data_day[6].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">17 - 18:30</td>
                            <td class="td_tb">{{this.data_day[7].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[7].includes(user_data.id),7,all_data_day.d_j)">{{this.data_day[7].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">18:30 - 20</td>
                            <td class="td_tb">{{this.data_day[8].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[8].includes(user_data.id),8,all_data_day.d_j)">{{this.data_day[8].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                        <tr>
                            <td class="td_tb">20 - 21:30</td>
                            <td class="td_tb">{{this.data_day[9].length}} نفر</td>
                            <td class="td_tb" @click="reserv(data_day[9].includes(user_data.id),9,all_data_day.d_j)">{{this.data_day[9].includes(this.user_data.id) ? "رزرو شده" : "رزرو"}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        
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
    }),
    created(){
        Axios.get('/api/getreserve_date')
        .then((res) => {
            this.days = res.data.data

        })
    },
    methods:{
        select_day:function(day){
            this.all_data_day = day
            this.data_day = JSON.parse(day.data)
        },
        reserv:function(status,whtime,whdate){
            Axios.post('/api/reserv',{
                data : {'status' : status , 'time' : whtime , 'whdate' : whdate}
            }).then((res)=>{
                this.days = res.data.data
            }).then(()=>{
                this.days.map((id)=>{
                    if(id.id == this.select){
                        this.all_data_day = id
                        this.data_day = JSON.parse(id.data)
                    }
                })
            })
        }
    },
    
}
</script>