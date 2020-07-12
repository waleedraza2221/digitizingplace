<template>
  <v-app id="keep">
    <v-app-bar
      app
      clipped-left
      color="amber"
    >
      <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
      <span class="title ml-3 mr-5">DP&nbsp;<span class="font-weight-light">Client</span></span>
      <v-text-field
        solo-inverted
        flat
        hide-details
        label="Search"
        prepend-inner-icon="mdi-magnify"
      ></v-text-field>

      <v-spacer></v-spacer>
    </v-app-bar>

    <v-navigation-drawer
      v-model="drawer"
      app
      clipped
      color="grey lighten-4"
    >
      <v-list
        dense
        class="grey lighten-4"
      >
        <template v-for="(item, i) in items">
          <v-row
            v-if="item.heading"
            :key="i"
            align="center"
          >
            <v-col cols="6">
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-col>
            <v-col
              cols="6"
              class="text-right"
            >
              <v-btn
                small
                text
              >edit</v-btn>
            </v-col>
          </v-row>
          <v-divider
            v-else-if="item.divider"
            :key="i"
            dark
            class="my-4"
          ></v-divider>
            <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            :prepend-icon="item.model ? item.icon : item['icon-alt']"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link
            >
              <v-list-item-action v-if="child.icon">
                <v-icon>mdi-{{ child.icon }}</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>


          <v-list-item
            v-else
            :key="i"
            link
            :to="item.action"

          >
            <v-list-item-action>
              <v-icon>mdi-{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title class="grey--text">
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

          

          

        </template>


          <v-list-item link @click='logout'>
          <v-list-item-action>
            <v-icon color="grey darken-1">mdi-logout</v-icon>
          </v-list-item-action>
          <v-list-item-title class="grey--text text--darken-1">Logout</v-list-item-title>
        </v-list-item>
      </v-list>



    </v-navigation-drawer>

    <v-main>
      <v-container
        fluid
        class="grey lighten-4"
      >
         <router-view>
             
         </router-view>
        <v-row
          justify="center"
          align="center"
        >
          <v-col class="shrink">
            <!-- <v-tooltip right>
              <template v-slot:activator="{ on }">
                <v-btn
                  :href="source"
                  icon
                  large
                  target="_blank"
                  v-on="on"
                >
                  <v-icon large>mdi-code-tags</v-icon>
                </v-btn>
              </template>
              <span>Source</span>
            </v-tooltip> -->

          </v-col>

 

        </v-row>
        
      </v-container>
 
    </v-main>
  </v-app>
</template>

<script>
  export default {
    props: {
      source: String,
    },
    data: () => ({
      drawer: null,
     
      items: [
        { icon: 'monitor', text: 'Dashboard', action:'/client/home' },
          { icon: 'upload', text: 'Direct Order'},
           { icon: 'currency-usd-circle', text: 'Get Quote' ,action:'/client/getquote'},
        { divider: true },
      

        { icon: 'image-multiple', text: 'My Designs' , action:'/client/alldesigns' },
        { icon: 'progress-clock', text: 'Working On' , action:'/client/alldesigns' },
         { icon: 'clock-time-five', text: 'Awaiting Payment' , action:'/client/alldesigns' },
      

        { divider: true },

          {
          icon: 'mdi-chevron-up',
          'icon-alt': 'mdi-chevron-down',
          text: 'Payments',
          model: false,
          children: [
            { text: 'Transactions History' ,icon: 'text-box' },
           
          
          ],
        },
      
     
      
        { divider: true },
        { icon: 'cog', text: 'Settings' },
       
        { icon: 'help', text: 'Contact Us' , action:'/client/contactus' },

      ],
    }),


     methods:{
      logout:function(){
localStorage.removeItem('token');
localStorage.removeItem('loggedin');
 this.$router.push('/client/login').then(res=>console.log('LoggedOut Successfully')).catch(err=>res=>console.log(err))
      }
    }
  }
</script>

<style>
#keep .v-navigation-drawer__border {
  display: none
}
</style>