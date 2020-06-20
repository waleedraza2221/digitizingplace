
import Vue from 'vue';
import VueRouter from 'vue-router';
//import { component } from 'vue/types/umd';
const foo={template:"<v-alert type='error'>I am foo Componenet</v-alert>"}
const bar={template:"<v-alert type='error'>I am bar Componenet</v-alert>"}
const user={template:"<v-alert type='info'>I am User Componenet{{$route.params.name}}</v-alert>"}
Vue.use(VueRouter)


const routes=[
    {

        path:'/foo',
        component:foo,
    },
    {

        path:'/bar',
        component:bar,

    },
    {

        path:'/user/:name',
        component:user,

    }



]
export default new VueRouter({routes})