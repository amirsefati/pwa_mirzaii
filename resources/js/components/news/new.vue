<template>
    <div>
        <div style="padding:20px">
        <p style="font-size:20px">آرشیو اخبار برنامه :</p>
        <ul>
            <li v-for="item in news" :key="item.id">
                <a :href="'/news/allnews/' + item.id">{{item.title}}</a>
            </li>
        </ul>
        </div>
    </div>
</template>

<script>
import Axios from 'axios'
export default {
    data:()=>({
        news : []
    }),
   created(){
       Axios.get('/api/getallnews')
       .then((res)=>{
           this.news = res.data.news
       })
   }
}
</script>