<template>
    <div>

  <v-row justify="center">
    <v-dialog
      v-model="dialog"
      hide-overlay
      fullscreen
      transition="dialog-bottom-transition"
    >
      <v-card>
         
        <v-toolbar
          dark
          color="primary"
          style="z-index:-1"
        >
          <v-spacer>
          </v-spacer>
          <v-toolbar-items>
            


          </v-toolbar-items>


        </v-toolbar>
        
        <v-divider></v-divider>
            <div style="padding:20px">
                   <span style="float:left" @click="dialog = false">
                      <img src="./../img/close.png" width="30px" alt="">
                    </span>
                <div>
                   
                    <p style="font-size:18px">{{this.title}}</p>
                    
                    <p>نویسنده : {{this.author}}</p>
                    

                </div>
                <br/>
                    <div v-html="desc"></div>

                    <p>#{{this.hashtag}}</p>

            </div>

      </v-card>
    </v-dialog>
  </v-row>
        <br>
        <div class="row">
          <div class="col-md-12 pr-4 pb-1">
              <p style="font-size:18px;margin-bottom:2px">بخش آموزش ها</p>

          </div>
        </div>

       <v-row justify="space-around">
        <v-col
        cols="12"
        sm="12"
        md="12"
        >
        <v-sheet
            elevation="10"
            class="py-2 px-1"
        >
            <v-chip-group
            mandatory
            active-class="primary--text"
            >
            <v-chip
                v-for="tag in tags"
                :key="tag"   
            >
              <span v-on:click="filter(tag)">{{ tag }}</span>  
            </v-chip>
            </v-chip-group>
        </v-sheet>
        </v-col>
    </v-row>

    <v-row class="px-4">
        <v-col  v-for="newb in news" :key="newb.id"
        cols="12"
        sm="6"
        md="4" 
        class="p-1"
        >
        <div class="learn_box_item" :style="backgrd(newb.cate)">
        <v-row @click="[dialog = true,gotonews(newb)]" >
            <v-col
            cols="4"
            sm="5"
            md="2"
            class="pl-0"
            >
                <img style="padding-right:8px;margin-top:3px" v-bind:src="newb.img" class="learn_box_item_img" alt="">
            </v-col>

            <v-col
            cols="8"
            sm="7"
            md="10"
            class="py-1">
                <v-row>
                    <v-col >
                        <p class="learn_box_item_title mt-2">{{newb.title}}</p>
                        <p class="learn_box_item_desc mb-0 pl-1" v-html="newb.desc.substring(0,90)+' ...'">
                        </p>

                    </v-col>
                </v-row>
                
            </v-col>
        </v-row>
          </div>

            <div class="learn_box_item_hashtag">
                #{{newb.hashtag}}
            </div>

            <div class="learn_box_item_auther">
                {{newb.author}}
            </div>
        </v-col>
        
    </v-row>
    </div>
</template>

<script>
 import './learn.css'
 import Axios from 'axios'
  export default {
    data: () => ({
      tags: [
        'همه',
        'آموزش های تخصصی تیراندازی',
        'تغذیه',
        'حرکات اصلاحی و آسیب شناسی',
        'روان شناسی ورزشی',
        'نکات عمومی',
      ],
      backupnews : [],
      news : [],
      dialog: false,
      notifications: false,
      widgets: false,
      title : '',
      author : '',
      desc : '',
      cate : '',
      hashtag : '',
      img : '',
      search:[]
    }),

    created(){
        Axios.get('/api/getlearn')
        .then((res)=>{
            console.log(res.data)
            this.news = res.data
            this.backupnews = res.data
        })
    },
    methods:{
        gotonews:function(id){
            this.title = id.title
            this.desc = id.desc
            this.author = id.author
            this.hashtag = id.hashtag

        },
        backgrd:function(cate){
            if(cate == 'تغذیه'){
              return {
                background:'red'
              }
          }
            else if(cate == 'آموزش های تخصصی تیراندازی'){
              return {
                background:'#1B9AAA'
              }
            }
            else if(cate == 'روان شناسی ورزشی'){
              return {
                background:'green'
              }
            }
            else if(cate == 'حرکات اصلاحی و آسیب شناسی'){
              return {
                background:'#413620'
              }
            }
            else{
              return {
                background:'#52154E'
              }
            }

        },
        filter:function(txt){
          if(txt == 'همه'){
            this.news = this.backupnews

          }else{
            this.search = []
            this.backupnews.map((cc)=>{
              if(cc.cate == txt){
                this.search.push(cc)
              }
              this.news = []
              this.news = this.search
            })
          }
         
        }
    }    
  }
</script>