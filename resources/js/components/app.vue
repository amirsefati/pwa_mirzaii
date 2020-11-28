<template>
    <div class="container-fluid p-0" data-app>

        <div class="sticky_navbar" id="sticky_navbar">
            <div class="row">
                <div class="col-md-4 col-4" style="text-align:right;padding-right:25px;">
                    <img src="./img/menumobile.png" style="width:30px;" alt="">
                </div>
                <div class="col-md-4 col-4" style="text-align:center"></div>
                <div class="col-md-4 col-4" style="text-align:left;padding-left:28px">
                    <router-link to="/">
                        <img src="./img/home.png" style="width:30px;" alt="">
                    </router-link>

                </div>

            </div>
        </div>
       <div class="row app_background_header">
           <div class="row pt-2">
               <div class="col-md-2 col-5" style="text-align:center">
                   <img src="./img/profile.png" class="img_profile pt-2" alt="">
               </div>
               <div class="col-md-10 col-7">
                   <div class="row">
                       <div class="col-md-12">
                           <p class="name_profile">علیرضا میرزایی</p>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-12 pb-0">
                           <p class="code_meli_profile"> کد ملی : 002154059</p>
                       </div>
                   </div>

                   <div class="row">
                       <div class="col-md-12">
                           <p class="code_b_profile"> کد باشگاه : 1652220</p>
                       </div>
                   </div>
               </div>
           </div>
       </div>

       <div class="row app_background_header_clippath">

       </div>

        <router-view>
        </router-view>
    </div>
</template>

<script>
     export default {
    data: () => ({
      model: null,
    }),
  }
</script>
