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
                      <img  src="./../img/close.png" width="30px" alt="">
                    </span>
                <div> 
                    <p style="font-size:18px">{{this.title}}</p>
                    <span style="font-size:13px">{{this.timer}}</span>
                    <br>
                    <img v-bind:src="this.img" style="width:100%" alt="">
                </div>

                <br/>
                    <div v-html="desc"></div>

                    قیمت :
                    <span style="font-size:13px">{{this.price}} هزار تومان</span>
                    <br/>

                    ظرفیت :
                    <span style="font-size:13px">{{this.quantity}} نفر</span>
                    <br/>

                    شرایط ثبت نام :
                    <span style="font-size:13px">{{this.conditions}}</span>
                    <br/>

                    لینک ثبت نام :
                    <span style="font-size:13px">{{this.link_singup}}</span>
                    <br/>
                    <br/>

            </div>

      </v-card>
    </v-dialog>
  </v-row>


      <div class="row mt-3 mb-2">
        <div class="col-md-3 col-3"></div>
        <div class="col-md-3 col-3 campetition_filter"  @click="filter('مسابقات')"><p style="margin-bottom:1px">مسابقات</p></div>
        <div class="col-md-3 col-3 campetition_filter_2" @click="filter('نتایج')"><p style="margin-bottom:1px">نتایج</p></div>

      </div>

    <v-row class="px-4">
        <v-col  v-for="newb in news" :key="newb.id"
        cols="12"
        sm="6"
        md="4" 
        class="p-1"
        >
        <div class="learn_box_item" :style="backgrd(newb.etc)">
        <v-row @click="[dialog = true,gotonews(newb)]" >
            
            <v-col
            cols="12"
            sm="12"
            md="12"
            class="py-1">
                <v-row>
                    <v-col class="p-4">
                        <p class="learn_box_item_title">{{newb.title}}</p>
                        <p class="learn_box_item_desc" v-html="newb.desc.substring(0,140)+' ...'">
                        </p>

                    </v-col>
                </v-row>
                
            </v-col>
        </v-row>
          </div>

            <div class="learn_box_item_quantity">
                ظرفیت :
                <span style="font-size:13px">{{newb.quantity}} نفر</span>
            </div>

            <div class="learn_box_item_hashtag">
                تاریخ مسابقه :
                <span style="font-size:13px">{{newb.timer}}</span>
            </div>

        </v-col>
        
    </v-row>
    </div>
</template>

<script>
 import './competition.css'
 import Axios from 'axios'
  export default {
    data: () => ({
      tags: [
        'همه',
        
      ],
      backupnews : [],
      news : [],
      dialog: false,
      notifications: false,
      widgets: false,
      title : '',
      desc : '',
      
      timer : '',
      quantity : '',
      price : '',
      award : '',
      conditions : '',
      link_singup : '',
      status : '',


      img : '',
      search:[]
    }),

    created(){
        Axios.get('/api/getcompetition')
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
            this.img = id.img

            this.timer = id.timer
            this.quantity = id.quantity
            this.price = id.price
            this.award = id.award
            this.conditions = id.conditions
            this.link_singup = id.link_singup
            this.status = id.status

        },
        backgrd:function(cate){
            if(cate == 'مسابقات'){
              return {
                background:'#6A4C93'
              }
          }
            else{
              return {
                background:'#1982C4'
              }
            }

        },
        filter:function(txt){
          if(txt == 'همه'){
            this.news = this.backupnews

          }else{
            this.search = []
            this.backupnews.map((cc)=>{
              if(cc.etc == txt){
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