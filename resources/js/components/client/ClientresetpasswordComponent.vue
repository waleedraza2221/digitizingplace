<template>

 <v-app id="inspire">
    <v-main>
      <v-container
        class="fill-height"
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
          >
            <v-card class="elevation-12">
              <v-toolbar
                color="red"
                dark
                flat
              >
                <v-toolbar-title>Reset Passsword</v-toolbar-title>
                   <v-progress-linear
                    :active="loading"
                    :indeterminate="loading"
                     absolute
                      top
                      color="amber accent-4"
                  ></v-progress-linear>
                <v-spacer></v-spacer>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                   
                      icon
                      large
                      target="_blank"
                      v-on="on"
                    >
                      <v-icon>mdi-account</v-icon>
                    </v-btn>
                  </template>
                  <span>Register</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>
                <v-form v-model="valid" method="post" v-on:sumbit.stop.prevent="reset">

            
                 <v-text-field color="error"
                    id="password"
                    label="Password"
                    v-model="password"
                    name="password"
                  
                   
                    :rules="passwordRules"
                    required
                     prepend-icon="mdi-lock"
                   
                    :type="show1 ? 'text' : 'password'"
                     
                     :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                       @click:append="show1 = !show1"
                  />
                   <v-text-field color="error"
                    id="rpassword"
                    label="Retype Password"
                    v-model="rpassword"
                    name="rpassword"
                    :rules="[passwordMatch]"
                    :append-icon="show4 ? 'mdi-eye' : 'mdi-eye-off'"
                    :type="show4 ? 'text' : 'password'"
                    prepend-icon="mdi-lock"
                    @click:append="show4 = !show4"
                  />




                </v-form>
                 <v-alert v-if="errortxt"  type="error"
                 
                 >

      {{errortxt}}
    </v-alert>

      
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red"  @click="login">Close</v-btn>
                 <v-btn type="submit" color="red" :disabled="!valid"  @click.prevent="reset">Reset</v-btn>
              </v-card-actions>
            </v-card>

           <v-snackbar
      v-model="snackbar"
      color="amber"
    >
      {{ errortxt }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="primary"
          text
          v-bind="attrs"
          @click="snackbar = false"
        >
          Close
        </v-btn>
      </template>
             </v-snackbar>

          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>



</template>
<script>
export default {


    data(){
return{
        show1: false,
       
        show4: false,
        password: '',
         rpassword:'',
        rules: {
          required: v => !!v || 'Required.',
       
          min: v => v.length >= 8 || 'Min 8 characters',
          emailMatch: () => (`The  password you entered don't match`),
         
        },
         passwordRules: [
          v => !!v || 'Password is required',
        ],

      loading:false,
    snackbar:false,
       errortxt:'',
      valid: true,
        }

    },
    mounted() {
            console.log('Reset Password Client')
        },
         computed:{
      passwordMatch(){
        return this.password != this.rpassword ? 'Password Does Not Match' : true
      },
    },
        methods:{
            login:function(){

               this.$router.push('/client/login');

            },

            reset:function(){
            
                    axios.interceptors.request.use((config)=> {
    this.loading=true;
    return config;
  },  (error) =>{
   this.loading=false;
    return Promise.reject(error);
  });

// Add a response interceptor
axios.interceptors.response.use( (response) =>{
    this.loading=false;
    return response;
  },  (error) =>{
    this.loading=false;
    return Promise.reject(error);
  });
    axios.post(this.$apipath+'resetsetpassword',{'password':this.password,'m':this.$route.query.asse,'t':this.$route.query.assett}).then(res=>{

      console.log(res)
         this.errortxt=res.data
      this.snackbar=true
 
   //localStorage.setItem('token',res.data.token)
   //localStorage.setItem('loggedin',true)


  })
  .catch(err=>{
   // console.log(err)
   this.errortxt="Email Not Found Please Contact Admin "
   //this.errortxt=err.response.message
   this.snackbar=true;
    })
 


            }



        }
}
</script>
<style scoped>

</style>