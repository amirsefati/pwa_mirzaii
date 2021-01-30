<template>
    <div style="padding:15px">
        <p>گزارش عملکرد</p>
        <v-data-table
            :headers="headers"
            :items="items"
            :items-per-page="50"
        >
            <template v-slot:item.kind_operation="{ item }">
                <p :style="getColor(item)">{{ item.kind_operation === 'رزرو' ? 'رزرو' : 'لغو' }}</p>
            </template>
        </v-data-table>
    </div>
</template>


<script>
import './list_reserve.css'
import Axios from 'axios'
export default {
    data: () => ({
        headers: [
          { text: 'ردیف', value: 'id' },
          { text: 'عملیات', value: 'kind_operation' },
          { text: 'شرح', value: 'etc1' },
          { text: 'تاریخ', value: 'created_at' },
        ],
        items: []
    }),
    created(){
        Axios.get('/api/get_list_reserve')
        .then((res)=>{
            if(res.data.status === '200'){
                this.items = res.data.data
            }
        })
    },
    methods:{
         getColor:function(status){
            if (status.kind_operation === 'لغو'){
                return {color:"red"}
            }
            else{
                return {color:"green"}
            }
      }
    }
}
</script>