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
                    <p style="font-size:20px;margin-bottom:3px">{{this.name}}</p>
                        <span style="font-size:14px" v-if="this.kind == 7">
                          بین المللی آسیایی A
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 6">
                          بین المللی آسیایی B
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 5">
                          بین المللی آسیایی C
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 4">
                          بین المللی آسیایی D
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 3">
                         مربی درجه یک 
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 2">
                         مربی درجه دو
                        </span>
                        <span style="font-size:14px" v-if="this.kind == 1">
                         مربی درجه سه
                        </span>
                    <br>
                    <br>
                    <img v-bind:src="this.img" style="width:100%" alt="">
                    <br>
                    <br>
                    <p style="font-size:18px">{{this.name}}</p>
                                        

                </div>
                 رشته تخصصی :
                    <span style="font-size:13px">{{this.guns}} </span>
                    <br/>

                     هشتگ :
                    <span style="font-size:13px">{{this.hashtag}} </span>
                    <br/>
                    <br/>
                    <div v-html="desc"></div>
                    
            </div>

      </v-card>
    </v-dialog>
  </v-row>

  <br>
    <v-row class="px-3">
        <v-col  v-for="newb in news" :key="newb.id"
        cols="6"
        sm="6"
        md="6" 
        class="p-3"
        >
        <div class="coach_box_item" >
        <v-row @click="[dialog = true,gotonews(newb)]" >
            
            <v-col
            cols="12"
            sm="12"
            md="12"
            class="py-1 border_coach_box"
            :style="backgrd(newb.kind)"
            >
                <v-row>
                    <v-col class="p-2">
                        <br>
                        <img v-bind:src="newb.img" class="corner_img" style="border-radius:20px;padding:5px" width="100%" alt="">
                        <p class="name_coach_item" style="font-size:13px">{{newb.name}}</p>
                        <p class="learn_box_item_desc" v-html="newb.desc.substring(0,90)+' ...'">
                        </p>
                    </v-col>
                    <div class="learn_box_item_auther_2">
                        <span style="font-size:8px" v-if="newb.kind == 7">
                          بین المللی آسیایی A
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 6">
                          بین المللی آسیایی B
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 5">
                          بین المللی آسیایی C
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 4">
                          بین المللی آسیایی D
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 3">
                         مربی درجه یک 
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 2">
                         مربی درجه دو
                        </span>
                        <span style="font-size:8px" v-if="newb.kind == 1">
                         مربی درجه سه
                        </span>
                    </div>

                    <div class="learn_box_item_hashtag">
                        #{{newb.hashtag}}
                    </div>
                    <br/>
                </v-row>
                
            </v-col>
        </v-row>
            
          </div>

            
        </v-col>
        
    </v-row>
    </div>
</template>

<script>
 import './coach.css'
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
      name : '',
      desc : '',
      guns : '',
      hashtag : '',
      kind : '',

      img : '',
      search:[]
    }),

    created(){
        Axios.get('/api/getcoach')
        .then((res)=>{
            console.log(res.data)
            this.news = res.data
            this.backupnews = res.data
        })
    },
    methods:{
        gotonews:function(id){
            this.name = id.name
            this.desc = id.desc
            this.img = id.img
            this.guns = id.guns
            this.hashtag = id.hashtag
            this.kind = id.kind

            

        },
        backgrd:function(cate){
            if(cate == 1){
              return {
                background:'#F36886'
              }
          }
            else if(cate == 2){
              return {
                background:'#F57A95'
              }
            }
            else if(cate == 3){
              return {
                background:'#F14167'
              }
            }
            else if(cate == 4){
              return {
                background:'#EE1B49'
              }
            }
            else if(cate == 5){
              return {
                background:'#D1103A'
              }
            }
             else if(cate == 6){
              return {
                background:'#BE0E34'
              }
            }
            else{
              return {
                background:'#AB0D2F'
              }
            }

        },
    }    
  }
</script>