<template>
<v-container class="fill-height grey lighten-5"
        fluid >
  
    <v-row
      class="mb-12"
  
      no-gutters
    >
        <v-container fluid>


      <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="yellow darken-2"
      ></v-progress-linear>

 <h5 class="text-h6">Personal Info</h5>
 <v-form  ref="form1"
    v-model="valid1"
    lazy-validation >
 <v-row>

  
        <v-col
          cols="12"
          sm="6"
           
        >
          <v-text-field
            v-model="name"
            label="Name"
             required
              :rules="nameRules"
          ></v-text-field>
        </v-col>

           <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="email"
            label="Email"
             :rules="emailRules"
             readonly
             disabled
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="phone"
            label="Phone"
            :rules="phoneRules"
            clearable
             required
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
        
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <v-btn
      tile
      color="lime"
   @click="savepersonalinfo()"
    >
   
      Save
    </v-btn>
        </v-col><v-col
          cols="12"
          sm="6"
        >
        
        </v-col>
   
      </v-row>
      </v-form>


        </v-container>
    </v-row>

    <v-divider></v-divider>
 <v-row
      class="mb-12"
  
      no-gutters
    >
 
        <v-container fluid>
 <h5 class="text-h6">Billing Info</h5>
      <v-form
    ref="form2"
     v-model="valid2"
    lazy-validation
  >
 <v-row>


        <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.name"
             :rules="nameRules"
            label="Name"
            clearable
            required
          ></v-text-field>
        </v-col>

           <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.email"
            label="Email"
             :rules="emailRules"
            clearable
          required
          ></v-text-field>
        </v-col>
        <v-col>
         <v-text-field
            v-model="billing.phone"
            label="Phone"
             :rules="phoneRules"
            clearable
          
          ></v-text-field>
        </v-col>

        <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.address1"
            label="Address 1"
            clearable
             required
          ></v-text-field>
        </v-col>

      
       <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.address2"
            label="Address 2"
            clearable
          ></v-text-field>
        </v-col>
         <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.postalcode"
            label="Postal Code"
            clearable
          ></v-text-field>
        </v-col>
         <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.city"
            label="City"
            clearable
          ></v-text-field>
        </v-col>

          <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.state"
            label="State"
            clearable
          ></v-text-field>
        </v-col>
          <v-col
          cols="12"
          sm="6"
        >
          <v-text-field
            v-model="billing.country"
            label="Country"
            clearable
          ></v-text-field>
        </v-col>
         <v-col
          cols="12"
          sm="6"
        >
      
        </v-col>

        
        <v-col
          cols="12"
          sm="6"
        >
          <v-btn
      tile
      color="lime"
    @click="savebillinginfo()"
    >
     
      Save
    </v-btn>
        </v-col><v-col
          cols="12"
          sm="6"
        >
        
        </v-col>
    
      </v-row>
  </v-form>

<v-divider></v-divider>
   <v-container fluid>
   <h5 class="text-h6">Security</h5>
     <v-form v-model="valid" method="post" ref="form3" v-on:sumbit.stop.prevent="reset">

             <v-text-field color="error"
                    id="oldpassword"
                    label="Old Password"
                    v-model="oldpassword"
                    name="oldpassword"
                  
                   
                    :rules="passwordRules"
                    required
                     prepend-icon="mdi-lock"
                   
                    :type="show1 ? 'text' : 'password'"
                     
                     :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                       @click:append="show1 = !show1"
                  />


                 <v-text-field color="error"
                    id="newpassword"
                    label="New Password"
                    v-model="newpassword"
                    name="newpassword"
                  
                   
                    :rules="passwordRules"
                    required
                     prepend-icon="mdi-lock"
                   
                    :type="show2 ? 'text' : 'password'"
                     
                     :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                       @click:append="show2 = !show2"
                  />
                   <v-text-field color="error"
                    id="rnewpassword"
                    label="Retype New Password"
                    v-model="rnewpassword"
                    name="rnewpassword"
                    :rules="[passwordMatch]"
                    :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show3 ? 'text' : 'password'"
                    prepend-icon="mdi-lock"
                    @click:append="show3 = !show3"
                  />


                   <v-btn type="submit" color="red" :disabled="!valid"  @click.prevent="reset">Save Password</v-btn>
             

                </v-form>
 




   </v-container>

        </v-container>
    </v-row>


   


 <v-snackbar
      :timeout="5000"
      :value=snackbar
    bottom
      color="black"
      elevation="24"
     
    >
      {{errortext}}.
    </v-snackbar>


  </v-container>
 
</template>
<script>
  export default {
    data () {
      return {
        name:'',
        phone:'',
        email:'',
        billing:[],
          show1: false,
       valid:true,
       valid1:true,
        valid2:true,
       
        show1: false,
        show2: false,
        show3:false,
        oldpassword:'',
  nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 20) || 'Name must be less than 20 characters',
      ],
        phoneRules: [
        v => !!v || 'Phone is required',
        v => (v && v.length <= 20) || 'Phone must be less than 20 characters',
      ],
        newpassword: '',
         rnewpassword:'',
        rules: {
          required: v => !!v || 'Required.',
          min: v => v.length >= 8 || 'Min 8 characters',
          emailMatch: () => (`The  password you entered don't match`),
         
        },
         passwordRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 8) || 'Min 8 characters',
        ],
        loading:false,
        design: {},
         emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
        errortext:'',
        snackbar:false,
         path:'/digitizingplace/public/api/',
      }
    },
    created () {
  
    this.initialize();
    },
    computed:{
         passwordMatch(){
        return this.newpassword != this.rnewpassword ? 'Password Does Not Match' : true
      },


    },

    methods:{

      reset(){
  
         if(this.$refs.form3.validate()){
                 axios.post(this.$apipath+'users/savepassword', {'oldpassword': this.oldpassword, 'newpassword': this.newpassword,})
          .then(res =>  {
            this.errortext = 'Password Changed Successfully';
            this.snackbar=true;      
          })
          .catch(err => {
             
             this.errortext = 'Old Password is in correct Kindly try again';
            this.snackbar=true;  
          })

            }
      },
        
        savepersonalinfo(){

            if(this.$refs.form1.validate()){
                 axios.post(this.$apipath+'users/savepersonalinfo', {'name': this.name, 'phone': this.phone,})
          .then(res =>  {
            this.errortext = res.data.message;
            this.snackbar=true;      
          })
          .catch(err => {
            console.dir(err)
             this.errortext = "Error Inserting Record"
             this.snackbar=true
          })

            }

        },

            savebillinginfo(){

            if(this.$refs.form2.validate()){
                 axios.post(this.$apipath+'users/savebillinginfo', {'billing': this.billing})
          .then(res =>  {
            this.errortext = res.data.message;
            this.snackbar=true;      
          })
          .catch(err => {
            console.dir(err)
             this.errortext = "Error Inserting Record"
             this.snackbar=true
          })

            }

        },

        initialize(){
 
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


        axios.post(this.$apipath+'users/getpersonalinfo').then(res=>{
         
             this.name=res.data.name,
            this.phone=res.data.phone,
            this.email=res.data.email,
             this.billing=res.data.billing
        
  
        }).catch();



        
      
        },



  

      
    }


  }
</script>
<style scoped>



</style>