
import Vue from 'vue';
import VueRouter from 'vue-router';
//import { component } from 'vue/types/umd';
import LoginComponent from './components/LoginComponent';
import RolesComponent from './components/RolesComponent';
import AdminComponent from './components/AdminComponent';
import AdminHomeComponent from './components/AdminHomeComponent';
import ClientComponent from './components/client/ClientComponent';
import ClientHomeComponent from './components/client/ClientHomeComponent';
import ContactUsComponent from './components/client/ContactUsComponent';
import AllDesignsComponent from './components/client/AllDesignsComponent';
import UserComponent from './components/UserComponent';
import ClientLoginComponent from './components/client/ClientLoginComponent';
import ClientRegisterComponent from './components/client/ClientRegisterComponent';


Vue.use(VueRouter)


const routes=[
    {

        path:'/client',
        redirect:'/client/login',
       
    },
    {

        path:'/client/register',
        component:ClientRegisterComponent,
        name:'ClientRegisterLogin'
       
    },
    {

        path:'/client/login',
        component:ClientLoginComponent,
        name:'ClientLogin'
    },
    {

        path:'/client/home',
        component:ClientComponent,
        name:'Client',
        redirect:'/client/home',
        children:[{
            


            path:'home',
            component:ClientHomeComponent,
            name:'home'

        },
        {
           

            path:'contactus',
            component:ContactUsComponent,
            name:'contactus'

        },
        {
           

            path:'alldesigns',
            component:AllDesignsComponent,
            name:'alldesigns'

        }
    
    ],
    beforeEnter: (to, from, next) => {
        axios.get('api/verify')
        .then(res=>next())
        .catch(err=>next('/client/login'))

        }
  
    },
    {

        path:'/',
        redirect:'/login',
       
    },
    {

        path:'/login',
        component:LoginComponent,
        name:'Login'
    },
    {

        path:'/admin',
        component:AdminComponent,
        name:'Admin',
        redirect:'/admin/home',
        children:[{
            


            path:'roles',
            component:RolesComponent,
            name:'Roles'

        },
        {
            


            path:'users',
            component:UserComponent,
            name:'Users'

        }
        ,{


            path:'home',
            component:AdminHomeComponent,
            name:'Home'
        }
    
    
    ],
        beforeEnter: (to, from, next) => {
          axios.get('api/verify')
          .then(res=>next())
          .catch(err=>next('/login'))

          }

    }
  



]
const router=new VueRouter({routes})
router.beforeEach((to,from,next)=>{
    const token=localStorage.getItem('token')|| null;
window.axios.defaults.headers['Authorization'] = "Bearer "+token;
next();

})

export default router