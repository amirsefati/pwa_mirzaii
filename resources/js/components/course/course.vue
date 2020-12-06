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
                    <p style="font-size:18px;margin-bottom:2px">{{this.title}}</p>
                    <p style="font-size:11px">نویسنده : {{this.author}}</p>

                    <br>
                    <img v-bind:src="this.img"  style="width:100%;border-radius:15px" alt="">
                   
                    
                    

                </div>
                <br/>
                    <div v-html="desc"></div>
                    
                    <hr class="hr"/>

                    قیمت :
                    <span style="font-size:13px">{{this.price}} هزار تومان</span>
                    <br/>

                    تاریخ ثبت نام :
                    <span style="font-size:13px">{{this.deadline}}</span>
                    <br/>

                    تاریخ  شروع:
                    <span style="font-size:13px">{{this.starting}}</span>
                    <br/>

                    مدارک مورد نیاز :
                    <span style="font-size:13px">{{this.documents}}</span>
                    <br/>

                    ظرفیت :
                    <span style="font-size:13px">{{this.quantity}}</span>
                    <br/>
                    <br/>

            </div>

      </v-card>
    </v-dialog>
  </v-row>
        <br/>  
        <div class="row">
          <div class="col-md-12 pr-4 pb-1">
              <p style="font-size:18px;margin-bottom:2px">بخش دوره ها</p>

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
            class="py-1  px-1"
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
        
    <v-row class="px-4 mb-5">
        <v-col  v-for="newb in news" :key="newb.id"
        cols="12"
        sm="6"
        md="4" 
        class="p-1"
        >
        <div class="learn_box_item" style="height:160px" :style="backgrd(newb.etc)">
        <v-row @click="[dialog = true,gotonews(newb)]" >
            
            <v-col
            cols="12"
            sm="12"
            md="12"
            class="py-1">
                <v-row>
                    <v-col class="p-4">
                        <p class="learn_box_item_title">{{newb.title}}</p>
                        <p class="learn_box_item_desc mt-2" style="font-size:10px" v-html="newb.desc.substring(0,180)+' ...'">
                        </p>

                    </v-col>
                </v-row>
                
            </v-col>
        </v-row>
          </div>

            <div class="learn_box_item_quantity">
                <span style="font-size:12px">{{newb.etc}}</span>
            </div>

            <div class="learn_box_item_hashtag">
                مهلت :
                <span style="font-size:11px">{{newb.deadline}}</span>
            </div>

            <div class="learn_box_item_auther">
                مربی : {{newb.author}}
            </div>
        </v-col>
        
    </v-row>
    </div>
</template>

<script>
 import './course.css'
 import Axios from 'axios'
  export default {
    data: () => ({
      tags: [
        'همه',
        'مربی گری',
        'داوری',
        'کارگاه ها',  
      ],
      backupnews : [],
      news : [],
      dialog: false,
      notifications: false,
      widgets: false,
      title : '',
      author : '',
      desc : '',
      count_hourse : '',
      price : '',
      deadline : '',
      documents : '',
      starting : '',
      quantity : '',

      img : '',
      search:[]
    }),

    created(){
        Axios.get('/api/getcourse')
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
            this.count_hourse = id.count_hourse
            this.price = id.price
            this.deadline = id.deadline
            this.documents = id.documents
            this.starting = id.starting
            this.quantity = id.quantity
            this.img = id.img

        },
        backgrd:function(cate){

          if(cate == 'مربی گری'){
              return {
                background:'#033F63'
              }
          }
            else if(cate == 'داوری'){
              return {
                background:'#292F36'
              }
            }
            else{
              return {
                background:'#034748'
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