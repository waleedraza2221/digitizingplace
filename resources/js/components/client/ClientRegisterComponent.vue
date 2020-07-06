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
                color="primary"
                dark
                flat
              >
                <v-toolbar-title>Register New Account</v-toolbar-title>
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
                    prepend-icon="mdi-account"
                    type="text"
                     :rules="emailRules"
                    v-model="email"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                     :rules="passwordRules"
                     required
                     v-model="password"
                  ></v-text-field>
                </v-form>
                 <v-alert v-if="errortxt"  type="error"
                 
                 >

      {{errortxt}}
    </v-alert>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="login">Close</v-btn>
                <v-btn color="primary" @click="register">Register</v-btn>
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
    password:'',
    emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      passwordRules:[
        v => !!v || 'Password is required',
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

            register:function(){

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
    axios.post(this.$apipath+'/registerclient',{'email':this.email,'password':this.password}).then(res=>{
   localStorage.setItem('token',res.data.token)
   localStorage.setItem('loggedin',true)

   if(res.data.isClient)
   {
      console.log('Logged IN Successfully')
       this.$router.push('/client').then(res=>console.log('Logged IN Successfully')).catch(err=>res=>console.log(err))
    }else{
      this.errortxt="You are not Authorize to Login Here"
      this.snackbar=true
    }

  })
  .catch(err=>{
   // console.log(err)
   this.errortxt="Please Enter Valid Email and Password"
   this.errortxt=err.response.data.status
   this.snackbar=true;
    })
 


            }



        }
}
</script>
<style scoped>

</style>