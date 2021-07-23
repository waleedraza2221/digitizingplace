
import Vue from 'vue';
import VueRouter from 'vue-router';
//import { component } from 'vue/types/umd';
import HomeComponent from './components/HomeComponent';
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
import ShowDesignComponent from './components/client/ShowDesignComponent';
import GetQuoteComponent from './components/client/GetQuoteComponent';
import ClientforgotpasswordComponent from './components/client/ClientforgotpasswordComponent';
import ClientresetpasswordComponent from './components/client/ClientresetpasswordComponent';
import ClientMyQuotesComponent from './components/client/ClientMyQuotesComponent';
import ViewQuoteComponent from './components/client/ViewQuoteComponent';
import SettingComponent from './components/client/SettingComponent';
import ThankYouComponent from './components/client/ThankYouComponent';
import TopUpHistoryComponent from './components/client/TopUpHistoryComponent';
import BalanceHistoryComponent from './components/client/BalanceHistoryComponent';
import AwaitingQuoteComponent from './components/admin/AwaitingQuoteComponent';
import adminViewQuoteComponent from './components/admin/adminViewQuoteComponent';
Vue.use(VueRouter)
const routes=[ 
    {
        path:'/client/register',
        component:ClientRegisterComponent,
        name:'ClientRegisterLogin'      
    },
    {
        path:'/client/forgotpassword',
        component:ClientforgotpasswordComponent,
        name:'Clientforgotpassword'
      

    },
    {
        path:'/client/resetpassword',
        component:ClientresetpasswordComponent,
        name:'Clientresetpassword'
    },
    {
        path:'/client/login',
        component:ClientLoginComponent,
        name:'ClientLogin'
    },
    {
        path:'/client',
        component:ClientComponent,
        name:'Client',
        redirect:'/client/home',
        children:[{
            path:'home',
            component:ClientHomeComponent,
            name:'home'

        },
        {
            path:'show',
            component:ShowDesignComponent,
            props: true,
            name:'show'
        },
        {
            path:'topuphistory',
            component:TopUpHistoryComponent,
            name:'topuphistory',
            
        },
        {
            path:'balancehistory',
            component:BalanceHistoryComponent,
            name:'balancehistory',
            props: true,
        },

        {
            path:'thankyou',
            component:ThankYouComponent,
            props: true,
            name:'thankyou'
        },
        

       
        {
            path:'setting',
            component:SettingComponent,
            props: true,
            name:'setting'
        },
        {
            path:'myquotes',
            component:ClientMyQuotesComponent,
            name:'myquotes'

        },
        {
            path:'viewquote',
            component:ViewQuoteComponent,
            name:'viewquote'
        },

        {
            path:'getquote',
            component:GetQuoteComponent,
            name:'getquote'
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
        component:HomeComponent,
        name:'Home'
       // redirect:'/client/login',   
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
        },
        {
            path:'awaitingquote',
            component:AwaitingQuoteComponent,
            name:'awaitingquote'
        },
        {
            path:'adminviewquote',
            component:adminViewQuoteComponent,
            name:'adminviewquote'
        },
        ,{
            path:'adminhome',
            component:AdminHomeComponent,
            name:'adminhome'
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