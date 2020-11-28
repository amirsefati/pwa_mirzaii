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
        >
          <v-btn
            icon
            dark
            @click="dialog = false"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>این خبر خاص</v-toolbar-title>
          <v-spacer>
          </v-spacer>
          <v-toolbar-items>
            <v-btn
              dark
              text
              @click="dialog = false"
            >
              بستن
            </v-btn>


          </v-toolbar-items>


        </v-toolbar>
        
        <v-divider></v-divider>
            <div style="padding:20px">
                   <span style="float:left" @click="dialog = false">
                      بازگشت   
                    </span>
                <div>
                    <p style="font-size:18px">{{this.title}}</p>

                    <img v-bind:src="this.img" style="width:100%" alt="">
                   
                    <p style="font-size:14px">{{this.desc}}</p>
                    <p style="font-size:14px">{{this.hashtag}}</p>

                    <p style="font-size:14px">{{this.kind}}</p>
                    <hr/>
                    <div v-html="desc2"></div>


                    <v-row>
                        <v-col
                        v-for="image in images"
                        :key="image"
                        class="d-flex child-flex"
                        cols="4"
                        >
                        <v-img
                            :src="image"
                            :lazy-src="image"
                            aspect-ratio="1"
                            class="grey lighten-2"
                        >
                            <template v-slot:placeholder>
                            <v-row
                                class="fill-height ma-0"
                                align="center"
                                justify="center"
                            >
                                <v-progress-circular
                                indeterminate
                                color="grey lighten-5"
                                ></v-progress-circular>
                            </v-row>
                            </template>
                        </v-img>
                        </v-col>
                    </v-row>

                </div>
                <br/>



                    
            </div>

      </v-card>
    </v-dialog>
  </v-row>


       <v-row justify="space-around">
        <v-col
        cols="12"
        sm="12"
        md="12"
        >
        <v-sheet
            elevation="10"
            class="py-4 px-1"
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
        <div class="gallery_box_item" :style="backgrd(newb.cate)">
        <v-row @click="[dialog = true,gotonews(newb)]" >
            
            <v-col
            cols="12"
            sm="12"
            md="12"
            class="py-1">
                <v-row>
                    <v-col class="p-4">
                        <img v-bind:src="newb.img" width="100%" alt="">
                        <p class="learn_box_item_title pt-2">{{newb.title}}</p>
                        <p class="learn_box_item_desc" v-html="newb.desc.substring(0,180)+' ...'">
                        </p>

                    </v-col>
                </v-row>
                <div class="time_box_timer">
                    {{newb.times}}
                </div>

                <div class="time_box_hashtag">
                    #{{newb.hashtag}}
                </div>
            </v-col>
        </v-row>
          </div>

            
        </v-col>
        
    </v-row>
    </div>
</template>

<script>
 import './gallery.css'
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
      desc2 : '',

      img : '',
      images : '',
      hashtag : '',
      kind : '',

      search:[]
    }),

    created(){
        Axios.get('/api/getgallery')
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
            this.images = JSON.parse(id.images)
            this.desc2 = id.desc2
            this.hashtag = id.hashtag
            this.kind = id.kind

        },
        backgrd:function(cate){
            if(cate == 'تغذیه'){
              return {
                background:'red'
              }
          }
            else if(cate == 'آموزش های تخصصی تیراندازی'){
              return {
                background:'blue'
              }
            }
            else if(cate == 'روان شناسی ورزشی'){
              return {
                background:'green'
              }
            }
            else{
              return {
                background:'brown'
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