<template>

 <v-container fluid>

      <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="yellow darken-2"
      ></v-progress-linear>
      <v-row dense>
       
        <v-card
    class="mx-auto"
    max-width="344"
    outlined
    shaped
    raised
    
    
  >


<v-form
    ref="form"
    v-model="valid"
    lazy-validation
  > 
    <v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-2">DP Balance</div>
        <v-list-item-title class="headline mb-1">{{balance}} $  <v-text-field
            v-model="amount"
            label="Add More Balance"
            :rules="amountRules"
          ></v-text-field>      </v-list-item-title>
       
      </v-list-item-content>

      <v-list-item-avatar
    
        size="80"
        color="lime"
      >
        <v-icon dark>mdi-currency-usd</v-icon>
      </v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn tile color="lime" block :disabled="!valid"  @click="ddd()">Top Up</v-btn>
      
    </v-card-actions>

</v-form>

  </v-card>

   <v-card
    class="mx-auto"
    max-width="344"
    outlined
    shaped
    raised
    color="cyan lighten-5"
    
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-2">Send Designs</div>
        <v-list-item-title class="headline mb-1">  <v-icon>mdi-file-upload</v-icon></v-list-item-title>
        <v-list-item-subtitle>Your Order will be auto created Price will be based on desing complexity</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
    
        size="80"
        color="blue"
      >
        <v-icon dark>mdi-file-upload</v-icon>
      </v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn text shaped outlined color="error" block  dressed   @click="designadd = true" >Upload Designs</v-btn>
      
    </v-card-actions>
  </v-card>


     <v-card
    class="mx-auto"
    max-width="344"
    outlined
    shaped
    raised
    color="teal lighten-5"
    
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-2">See All Invoices</div>
        <v-list-item-title class="headline mb-1"><v-icon>mdi-text-box</v-icon></v-list-item-title>
        <v-list-item-subtitle>See All Invoices Paid or Unpaid for New invoice Visit Payment Section </v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
    
        size="80"
        color="blue"
      >
        <v-icon dark>mdi-text-box</v-icon>
      </v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn text shaped outlined color="error"  block  dressed>See All Invoices</v-btn>
      
    </v-card-actions>
  </v-card>






    <v-dialog v-model="designadd" persistent max-width="600px">

      <v-card>
        <v-card-title>
          <span class="headline">Send Your Designs</span>
        </v-card-title>
        <v-card-text>
          <v-container>
              <div v-if="currentFile">
      <div>
        <v-progress-linear
          v-model="progress"
          color="light-blue"
          height="25"
          reactive
        >
          <strong>{{ progress }} %</strong>
        </v-progress-linear>
      </div>
    </div>
            <v-row>
           
              <v-col cols="12">
               <v-file-input small-chips multiple label="Add your Designs"  @change="selectFile"></v-file-input>
              </v-col>
              <v-col cols="12">

                    <v-checkbox  v-model="digitizing" label="Digitizing"></v-checkbox>
                   <v-checkbox label="Vector"></v-checkbox>
 
              </v-col>

               <v-col cols="12" >
        <v-textarea
          outlined
          required
          name="input-7-4"
          label="Description"
          value=""
        ></v-textarea>
      </v-col>
          
    <v-alert v-if="message" border="left" color="blue-grey" dark>
      {{ message }}
    </v-alert>
          
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="amber darken-1" text @click="designadd = false" >Close</v-btn>
          <v-btn color="amber darken-1" text @click="upload" >Send</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

      </v-row>
    </v-container>



  
  



</template>
<script>
export default {
    mounted() {
            console.log('CLient Home Component mounted.')

        },

    data: () => ({
      
      dialog: false,
        balance:0,
        amount:50,
         designadd: false,
         digitizing:true,
         files:[],
         valid:true,
        currentFile: undefined,
      progress: 0,
      loading:false,
      message: "",
         amountRules: [
        v => !!v || 'Amount is required',
        v => (v && v >= 20) || 'Amount must be Greater then 20 $',
      ],

      fileInfos: []

    }),


  created () {
  
    this.initialize();
 
    },


     methods: {
       
  ddd(){
    if(this.$refs.form.validate()){


     axios.post(this.$apipath+'users/getamount',{'amount':this.amount}).then(res=>{  
         
    TwoCoInlineCart.setup.setMode('DYNAMIC');
    TwoCoInlineCart.cart.setCurrency('USD');
    TwoCoInlineCart.products.add({
    name: 'Digitizing Place Top Up',
    quantity: 1,
    price: this.amount,
    });
    TwoCoInlineCart.cart.setReturnMethod({
    type: 'redirect',
    url : 'http:\/\/localhost:3000\/digitizingplace/public\/#\/client\/thankyou'
      });
  TwoCoInlineCart.cart.setTest(true);
  TwoCoInlineCart.cart.checkout();

      
            })
        .catch(err=>{

          alert('Error Occur Please try reloading page ');
           })

  }
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
  axios.post(this.$apipath+'users/getBalance').then(res=>{
            this.balance=res.data.balance
  })
  .catch(err=>{
    })
  axios.get(this.$apipath+'design').then(res=>{

            this.designs=res.data.designs

   //localStorage.setItem('token',res.data.token)
   //localStorage.setItem('loggedin',true)


  })
  .catch(err=>{
   // console.log(err)
    
   
  // this.errortxt=err.response.message
 
    })





     
      }


 


 

  }
 



}



</script>
<style scoped>

</style>