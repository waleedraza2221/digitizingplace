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
                <v-toolbar-title>Forgot Password?</v-toolbar-title>
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
                <v-form>

                 
                  <v-text-field
                    label="Email"
                    name="email"
                    prepend-icon="mdi-email"
                    type="text"
                     :rules="emailRules"
                    v-model="email"
                  ></v-text-field>

               
                </v-form>
                 <v-alert v-if="errortxt"  type="error"
                 
                 >

      {{errortxt}}
    </v-alert>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="red" @click="login">Close</v-btn>
                <v-btn color="red" @click="reset">Reset</v-btn>
              </v-card-actions>
            </v-card>
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
    email:'',
  
    emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],

      loading:false,
    snackbar:false,
       errortxt:'',
      valid: true,
        }

    },
    mounted() {
            console.log('Register Client')
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
    axios.post(this.$apipath+'resetpassword',{'email':this.email}).then(res=>{

      console.log(res)

      this.snackbar=true;
   //localStorage.setItem('token',res.data.token)
   //localStorage.setItem('loggedin',true)


  })
  .catch(err=>{
   // console.log(err)
   this.errortxt="Please Enter Valid Email"
  // this.errortxt=err.response.message
   this.snackbar=true;
    })
 


            }



        }
}
</script>
<style scoped>

</style>