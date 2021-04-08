
<template>

 <v-container  class="fill-height grey lighten-5"
        fluid >
    <v-row no-gutters>
      <v-col
        cols="12"
        sm="12"
      >
 <v-data-table
      item-key="id"
      class="elevation-1"
      color="error"
      :loading="loading"
      loading-text="Loading... Please wait"
      :headers="headers"
      @pagination="paginate"
      :server-items-length="balancehistory.total"
      :options.sync="options"
      :items="balancehistory.data"
      :items-per-page="15"
      :footer-props="{
      itemsPerPageOptions: [15,30,45],
      itemsPerPageText: 'Records Per Page',
      'show-current-page': true,
      'show-first-last-page': true
    }"
    >

    <template v-slot:item.amount="{ item }">
      <v-chip
        color="lime"
        dark
      >
        {{ item.amount }}
      </v-chip>
    </template>

     <template v-slot:item.created_at="{ item }">
           <span>{{new Date(item.created_at).toLocaleDateString()}}</span>
     </template>

     <template v-slot:item.action="{ item }">
       <v-btn
      tile
      color="success"
      @click="$router.push('balancehistory/?id='+item.refid)"
    >
    
      Open
    </v-btn>
    </template>
    </v-data-table>


    </v-col>
 </v-row>


</v-container>
</template>
<script>
export default {
    mounted() {
        axios
        .get(`${this.path}balancehistory`, {
        
        })
        .then(res => {
          this.balancehistory = res.data.balancehistory;
        })
        .catch(err => {
         // if (err.response.status == 401) localStorage.removeItem("token");
        //  this.$router.push("/login");
        });
        },

    data: () => ({
      loading: false,
       headers: [
      { text: "#", align: "left", sortable: false, value: "id" },
      { text: "RefNo", value: "refid" },
      { text: "Amount $", value: "amount" },
      { text: "Created At", value: "created_at" },
      { text: "Actions", value: "action" }
    ],
    balancehistory: [],
        options: {
      sortBy: ["created_at"],
      sortDesc: [true]
    },
    path:'/digitizingplace/public/api/',
    }),


  created () {
  
    this.initialize();

 
    },
    watch:{


         options:{
        handler(e){
            console.log(e);
        const sortBy =
        this.options.sortBy.length == 0 ? "created_at" : this.options.sortBy[0];
      const orderBy =
        this.options.sortDesc.length > 0 && this.options.sortDesc[0]
          ? "desc"
          : "asc";
    axios
        .get(`${this.path}balancehistory?page=${e.page}`, {
          params: {
            per_page: e.itemsPerPage,
            sort_by: sortBy,
            order_by: orderBy
          }
        })
        .then(res => {
          this.balancehistory = res.data.balancehistory;
        })
        .catch(err => {
         // if (err.response.status == 401) localStorage.removeItem("token");
        //  this.$router.push("/login");
        });
        },
        deep: true
      }
    },

     methods: {

         openItem(e){


         },
         paginate(e) {
      const sortBy =
        this.options.sortBy.length == 0 ? "created_at" : this.options.sortBy[0];
      const orderBy =
        this.options.sortDesc.length > 0 && this.options.sortDesc[0]
          ? "desc"
          : "asc";
      axios
        .get(`${this.path}balancehistory?page=${e.page}`, {
          params: {
            per_page: e.itemsPerPage,
            sort_by: sortBy,
            order_by: orderBy
          }
        })
        .then(res => {
          this.balancehistory = res.data.balancehistory;
        })
        .catch(err => {
         // if (err.response.status == 401) localStorage.removeItem("token");
        //  this.$router.push("/login");
        });
    },
   initialize () {
      

    // Add a request interceptor
axios.interceptors.request.use((config)=> {
  this.loading=true
    return config;
  },  (error) =>{

    return Promise.reject(error);
  });

// Add a response interceptor
axios.interceptors.response.use( (response) =>{
  this.loading=false
    return response;
  },  (error) =>{
  
    return Promise.reject(error);
  });





      }


 


 

  }
 



}



</script>
<style scoped>

</style>