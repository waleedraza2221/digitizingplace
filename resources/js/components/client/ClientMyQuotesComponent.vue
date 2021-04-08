<template>
<v-app id="inspire">
  <v-data-table 
  	item-key="name" 
  	class="elevation-1" 
  	color="error"
  	:loading = "loading"
  	loading-text="Loading... Please wait"
	  :headers="headers"
    :options.sync="options"
    :server-items-length="designs.total"
    :items="designs.data"

   
    :footer-props="{
      itemsPerPageOptions: [5,10,15],
      itemsPerPageText: 'Quotes Per Page',
      'show-current-page': true,
      'show-first-last-page': true
    }"
  >

  	<template v-slot:top>
      
      <v-toolbar flat color="dark">
        <v-toolbar-title>My Quotes</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>

    
            <v-btn  class="mb-1" @click="$router.push('getquote')">Send New Quote</v-btn>
           
      
      </v-toolbar>
      <v-row>
        <v-col cols="12">
          <v-text-field @input="searchIt" label="Search..." class="mx-4" ></v-text-field>
        </v-col>
      </v-row>
    </template>
    <template v-slot:item.action="{ item }">
      <v-icon
        small
        class="mr-4"
        @click="sendmail(item)"
      >
        mdi-email-send
      </v-icon>
   
    </template>
    <template v-slot:no-data>
      <v-btn color="error" @click="initialize">Reset</v-btn>
    </template>
           
  </v-data-table>
   <v-snackbar v-model="snackbar" >
               {{text}}
                <v-btn
                  color="error"
                  text
                  @click="snackbar = false"
                >
                  Close
                </v-btn>
              </v-snackbar>   
</v-app>
</template>
<script>
  export default {
    
    data: () => ({
      dialog: false,
      loading: false,
      snackbar: false,
      selected: [],
      text: '',
      options:{
        itemsPerPage: 5,
        sortBy:['id'],
        sortDesc: [false]
      },
      headers: [
       
        { text: 'Name', value: 'name' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },   
        { text: 'Send Reminder Mail', value: 'action'},
      ],
      designs: [],
      path:'/digitizingplace/public/api/',
      editedIndex: -1,
      editedItem: {
        id: '',
        name: '',
        created_at: '',
        updated_at: '',
      },
      defaultItem: {
        id: '',
        name: '',
        created_at: '',
        updated_at: '',
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New Role' : 'Edit Role'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
      options:{
        handler(e){
        console.dir(e);
        const sortBy = e.sortBy.length>0 ? e.sortBy[0].trim() : 'id';
        const orderBy = e.sortDesc[0] ? 'desc' : 'asc';

        axios.get(`${this.path}designs`,{params:{'page':e.page, 'per_page':e.itemsPerPage, 'sort_by': sortBy, 'order_by': orderBy}})
          .then(res => {
            this.designs = res.data.designs
          })
          .catch(err => {
            if(err.response.status == 401)
           localStorage.removeItem('token');
       this.$router.push('/login');
          } )
        },
        deep: true
      }
    },

    created () {
      this.initialize()
    },

    methods: {
    
  
      searchIt(e){
        if(e.length > 3){
          axios.get(`${path}designs/${e}`)
              .then(res => this.designs = res.data.designs)
              .catch(err => console.dir(err.response))
        }
        if(e.length<=0){
          axios.get(`${path}designs`)
              .then(res => this.roles = res.data.designs)
              .catch(err => console.dir(err.response))
        }
      },
      paginate(e){
        const sortBy = e.sortBy.length>0 ? e.sortBy[0].trim() : 'name';
        const orderBy = e.sortDesc[0] ? 'desc' : 'asc';
        axios.get(`${this.path}designs`,{params:{'page':e.page, 'per_page':e.itemsPerPage, 'sort_by': sortBy, 'order_by': orderBy}})
          .then(res => {
            this.roles = res.data.designs
          })
          .catch(err => {
            if(err.response.status == 401)
              localStorage.removeItem('token');
              this.$router.push('/login');
          } )
      },
      initialize () {
        // Add a request interceptor

       
        axios.interceptors.request.use((config) => {
            this.loading = true;
            return config;
          },  (error) => {
            this.loading = false;
            return Promise.reject(error);
          });
        // Add a response interceptor
        axios.interceptors.response.use( (response) => {
           this.loading = false;
            return response;
          },  (error) => {
           this.loading = false
            return Promise.reject(error);
          });

      },
      
      sendmail (item) {
        this.editedIndex = this.roles.data.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialog = true
      },
     

  

    },
  }
</script>
<style scoped></style>