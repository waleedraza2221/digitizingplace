<template>

 <v-container fluid>
      <v-row dense>
       
        <v-card
    class="mx-auto"
    max-width="344"
    outlined
    shaped
    raised
    color="amber lighten-5"
    
  >
    <v-list-item three-line>
      <v-list-item-content>
        <div class="overline mb-2">DP Balance</div>
        <v-list-item-title class="headline mb-1">{{amount}} $</v-list-item-title>
        <v-list-item-subtitle>This is Your DP balance You can load anytime</v-list-item-subtitle>
      </v-list-item-content>

      <v-list-item-avatar
    
        size="80"
        color="blue"
      >
        <v-icon dark>mdi-currency-usd</v-icon>
      </v-list-item-avatar>
    </v-list-item>

    <v-card-actions>
      <v-btn text shaped outlined color="error" block  dressed @click="dialog = true">Top Up</v-btn>
      
    </v-card-actions>
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


   <v-dialog v-model="dialog"  persistent max-width="600px">
     
      <v-card>
        <v-card-title>
          <span class="headline">Payment</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
   
           
            <v-btn block color="light"
             :href="`https://secure.2checkout.com/checkout/buy?merchant=250278707506&return-url=https%3A%2F%2Fwww.digitizingplace.com%2Fthank-you%2F%3Femail%3DEmail&return-type=redirect&tpl=default&prod=A2845B0F9D&qty=${amount}&signature=f72cf391bc08abcbdb21b71c292637e57978469540213fd7176deec72f546eff`"
            target="_blank"
             >Pay Now </v-btn>
            
            </v-row>
          </v-container>
      
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
          <!-- <v-btn color="blue darken-1" text @click="dialog = true">Save</v-btn> -->
        </v-card-actions>
      </v-card>
    </v-dialog>




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
        amount:50,
         designadd: false,
         digitizing:true,
         files:[],
        currentFile: undefined,
      progress: 0,
      message: "",
 

      fileInfos: []

    }),

     methods: {
  
   initialize () {
      

    // Add a request interceptor
axios.interceptors.request.use((config)=> {
 
    return config;
  },  (error) =>{

    return Promise.reject(error);
  });

// Add a response interceptor
axios.interceptors.response.use( (response) =>{
  
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