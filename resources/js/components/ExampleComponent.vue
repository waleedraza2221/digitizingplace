<template>
<div>
   <v-container>
       <v-alert type="info">I am Vuetify component  </v-alert>
       <v-btn link to="/foo">Load Foo</v-btn>
       <v-btn link to="/bar">Load bar</v-btn>
         <v-btn link to="/user/waleed">Load User</v-btn>
   </v-container>
    <v-content>
        <router-view></router-view>
   </v-content>
   </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
