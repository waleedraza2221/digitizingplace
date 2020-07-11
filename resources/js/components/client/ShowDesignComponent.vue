<template>


 <div>
   

    <v-tabs
      v-model="tab"
      background-color="amber accent-4"
      class="elevation-2"
      dark
      centered
        grow
       color="dark"
      :prev-icon="prevIcon ? 'mdi-arrow-left-bold-box-outline' : undefined"
      :next-icon="nextIcon ? 'mdi-arrow-right-bold-box-outline' : undefined"
      :icons-and-text="icons"
    >
      <v-tabs-slider></v-tabs-slider>

      <v-tab
      
        :href="deliveryfiles"
      >
        Delivery Files
        <v-icon v-if="icons">mdi-phone</v-icon>
      </v-tab>

      <v-tab-item
      
        :value="deliveryfiles"
      >
      <v-row>
             <v-col
          v-for="(item, i) in items"
          :key="i"
          cols="12"
        >
          <v-card
            :color="item.color"
            dark
          >
            <div class="d-flex flex-no-wrap justify-space-between">
              <div>
                <v-card-title
                  class="headline"
                  v-text="item.title"
                ></v-card-title>

                <v-card-subtitle v-text="item.artist"></v-card-subtitle>
              </div>

              <v-avatar
                class="ma-3"
                size="125"
                tile
              >
                <v-img :src="item.src"></v-img>
              </v-avatar>
            </div>
          </v-card>
        </v-col>
 <v-col cols="12" >
        <v-textarea
          outlined
          name="input-7-4"
          label="Please Enter Message If Needs to Done Anything on this design"
          value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
        ></v-textarea>
        <v-row>
             <v-col cols="11" >
             <v-file-input small-chips multiple label="File input w/ small chips"></v-file-input>
             </v-col>
             <v-col cols="1">
               <v-btn class="ma-2" outlined large fab color="indigo">
                 
      <v-icon>mdi-send</v-icon>
    </v-btn>
      </v-col>
        </v-row>
      </v-col>

        </v-row>
      </v-tab-item>


          <v-tab
      
        :href="invoice"
      >
        Invoice
        <v-icon v-if="icons">mdi-text-box</v-icon>
      </v-tab>

      <v-tab-item
      
        :value="invoice"
      >
        <v-card
          flat
          tile
        >
          <v-card-text>Invoice Here</v-card-text>
        </v-card>
      </v-tab-item>



        <v-tab
      
        :href="sourcefiles"
      >
        Source Files
        <v-icon v-if="icons">mdi-phone</v-icon>
      </v-tab>

      <v-tab-item
      
        :value="sourcefiles"
      >
        <v-card
          flat
          tile
        >
          <v-card-text>Source FIles</v-card-text>
        </v-card>
      </v-tab-item>



    </v-tabs>
  </div>

</template>
<script>
export default {
    mounted() {
            console.log('Show Design Component mounted.')
        },

          data () {
      return {
        tab: null,
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
        icons: false,
        centered: false,
        grow: false,
        vertical: false,
        prevIcon: false,
        nextIcon: false,
        right: false,
        tabs: 3,
         items: [
        {
          color: '#1F7087',
          src: 'https://cdn.vuetifyjs.com/images/cards/foster.jpg',
          title: 'Supermodel',
          artist: 'Foster the People',
        },
        {
          color: '#952175',
          src: 'https://cdn.vuetifyjs.com/images/cards/halcyon.png',
          title: 'Halcyon Days',
          artist: 'Ellie Goulding',
        }
      ],
      }
          }
}
</script>
<style scoped>

</style>