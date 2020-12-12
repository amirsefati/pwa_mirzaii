import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import VueRouter from 'vue-router'
import App from './components/app'
import App_menu from './components/app_menu'
import Learn from './components/learning/learn'
import Course from './components/course/course'
import Gallery from './components/gallery/gallery'
import Competition from './components/competition/competition'
import Coach from './components/coach/coach'
import Login from './components/login/login'
import Signup from './components/signup/signup'
import Verify from './components/verify/verify'
import Select from './components/reserve/select'
import Credit from './components/reserve/credit'
import Reserve from './components/reserve/reserve'
import About from './components/about/about'

import './app.css'

Vue.use(VueRouter)
Vue.use(Vuetify)

const router = new VueRouter({
    mode:'history',
    routes:[
        {path:'/',component:App_menu,props:true},
        {path:'/learning',component:Learn},
        {path:'/courseb',component:Course},
        {path:'/gallery2',component:Gallery},
        {path:'/competition2',component:Competition},
        {path:'/coach1',component:Coach},
        {path:'/login',component:Login},
        {path:'/signup',component:Signup},
        {path:'/verify',component:Verify},
        {path:'/select',component:Select},
        {path:'/credit',component:Credit},
        {path:'/reserve',component:Reserve},
        {path:'/about',component:About},

    ]
})

const app = new Vue({
    el: '#app',
    components:{App},
    router,
    vuetify: new Vuetify(
        {
            rtl: true,
          }
    )

})

window.onscroll = function() {
    scrollfunction()
}
var navbar = document.getElementById('sticky_navbar')
var sticky_navbar = navbar.offsetTop

function scrollfunction(){
    if(window.pageYOffset > sticky_navbar){
        navbar.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
    }
}