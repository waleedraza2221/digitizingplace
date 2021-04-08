
<template>
 <v-container>
        <v-row>
       <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="yellow darken-2"
      ></v-progress-linear>
          <v-col
            cols="12"
            sm="9"
           id="printMe">
         
         <v-row class="lime darken-1">
         <v-col cols="12" class="text-h4 text-center">Invoice </v-col>
         
       </v-row>
       <v-row class="lime">
         <v-col cols="6"><div class="text-h6">Refrence Number:  {{balancehistory.RefNo}}</div> </v-col>
          <v-col cols="6" class="text-h6 text-right">Date:  {{new Date(balancehistory.OrderDate).toDateString()}}</v-col>
       </v-row>

      <v-row>
        <v-col cols="5">
          <p>From: DigitizingPlace</p>
          <p>Phone: +1-424-477-2592</p>
          <p>Mail: admin@digitizingplace.com</p>
        </v-col>
           <v-col cols="2"></v-col>
              <v-col cols="5">
              <p>  To:  {{balancehistory.BillingDetails.FirstName}} {{balancehistory.BillingDetails.LastName}}</p>
              <p>Email: {{balancehistory.BillingDetails.Email}}</p>
              <p>Phone: {{balancehistory.BillingDetails.phone==null? '000000000': balancehistory.BillingDetails.phone}} </p>
              <p>Address: {{balancehistory.BillingDetails.Address1 }}{{balancehistory.BillingDetails.Address2==null? '':balancehistory.BillingDetails.Address2}} </p>

              </v-col>
      </v-row>

       <v-row>
 
         <v-col cols="12">
           <v-simple-table>
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">
            Description
          </th>
          <th class="text-left">
            Amount
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
        >
          <td>Digitizing Place TopUp</td>
          <td>{{balancehistory.NetPrice }}</td>
        </tr>
          <tr>
          <td></td>
          <td></td>
        </tr>
         <tr>
          <td></td>
          <td></td>
        </tr>
         <tr>
          <td class="text-right text-h6">Total: </td>
          <td>{{balancehistory.NetPrice }}  {{balancehistory.PayoutCurrency}}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
         </v-col>
      
       </v-row>


  
          </v-col>

          <v-col
            cols="12"
            sm="3"
          >
            <v-sheet
              rounded="lg"
              min-height="268"
            >
              <v-btn tile color="success" block @click="printinvoice()">Print Invoice  <v-icon> mdi-printer</v-icon> </v-btn>
              <!--  -->
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>

</template>
<script>
import AllDesignsComponentVue from './AllDesignsComponent.vue';
export default {
    mounted() {
      
        axios
        .post(`${this.path}balancehistory/show`,{
        'id':this.$route.query.id

        })
        .then(res => {
         this.balancehistory=res.data.balancehistory
        })
        .catch(err => {
         // if (err.response.status == 401) localStorage.removeItem("token");
        //  this.$router.push("/login");
        });
        },

    data: () => ({
      loading: false,
    balancehistory: [],
    path:'/digitizingplace/public/api/',
    }),


  created () {
  
    this.initialize();

 
    },

     methods: {
       printinvoice(){
      this.$htmlToPaper('printMe');
        // console.log(window);
        
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