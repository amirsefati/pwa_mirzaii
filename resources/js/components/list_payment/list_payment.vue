<template>
    <div style="padding:15px">
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="50"
        >
            <template v-slot:item.status="{ item }">
                <p :style="getColor(item.status)">{{ item.status ? 'موفق' : 'کنسل' }}</p>
            </template>
        </v-data-table>
    </div>
</template>


<script>
import './list_payment.css'
import Axios from 'axios'
export default {
    data: () => ({
        headers: [
          { text: 'ردیف', value: 'id' },
          { text: 'عملیات', value: 'status' },
          { text: 'قیمت', value: 'price' },
          { text: 'تاریخ پرداخت', value: 'created_at' },
        ],
        items: []
    }),
    created(){
        Axios.get('/api/get_list_payment')
        .then((res)=>{
            if(res.data.status === '200'){
                this.items = res.data.data
            }
        })
    },
    methods:{
         getColor:function(status){
            if (status > 0){
                return {color:"green"}
            }
            else{
                return {color:"red"}
            }
      }
    }
}
</script>