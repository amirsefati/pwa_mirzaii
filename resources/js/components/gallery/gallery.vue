<template>
    <div>

<div class="text-center">
    <v-bottom-sheet
      v-model="sheet"
      inset
    >
      
      <v-sheet
        class="text-center"
        height="70%"
      >
        <v-btn
          class="mt-6"
          text
          color="error"
          @click="sheet = !sheet"
        >
          بستن
        </v-btn>
        <div class="my-3">
          <img v-bind:src="this.img_hover" width="90%" alt="">
        </div>
      </v-sheet>
    </v-bottom-sheet>
  </div>

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
                            @click="showimg(image)"
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

    <v-row style="padding:15px">
        <v-col  v-for="newb in news" :key="newb.id"
        cols="6"
        sm="6"
        md="4"
        style="padding:2px 15px"
        >
        <v-row @click="[dialog = true,gotonews(newb)]" >
            
            <v-col
            cols="12"
            sm="12"
            md="12"
            class="py-0"
            style="box-shadow: 3px 3px 12px 0px rgba(0,0,0,0.25);"
            >
                <v-row>
                    <v-col class="">
                        <img v-bind:src="newb.img" width="100%" alt="">
                        <p class="learn_box_item_title pt-2" style="color:black;font-size:12px">{{newb.title}}</p>
                         <div class="learn_box_item_hashtag_3" style="color:gray">
                            {{newb.times}}
                          </div>
                    </v-col>
                </v-row>
                
            </v-col>
        </v-row>


        </v-col>
        <br><br>

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
      sheet: false,
      img_hover : '',

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
        showimg:function(img){
            this.img_hover = img
            this.sheet = true
        }
        
    }    
  }
</script>