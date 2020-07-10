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
                color="amber"
                dark
                flat
              >
                <v-toolbar-title>Welcome to Digitzing Place</v-toolbar-title>
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
                  <span>Client</span>
                </v-tooltip>
              </v-toolbar>
              <v-card-text>

                  <v-progress-linear
                    :active="loading"
                    :indeterminate="loading"
                     absolute
                      top
                      color="deep-purple accent-4"
                  ></v-progress-linear>
                <v-form>



                  <v-text-field
                    label="Login Email"
                    name="login"
                     v-model="email"
                    :rules="emailRules"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                     v-model="password"
                     :rules="passwordRules"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                 <v-btn color="amber" @click="register">Register</v-btn>
                <v-btn color="amber" @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
                     <v-snackbar
      v-model="snackbar"
      color="amber"
    >
      {{ txt }}

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

  return {
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
    txt:"",
      valid: true,
  }
},
    mounted() {
            console.log('Login Home Component mounted.')
        },

        methods: {
            register:function(){
                 this.$router.push('/client/register')
            },

 
  login: function(){
      // Add a request interceptor
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
    axios.post(this.$apipath+'clientlogin',{'email':this.email,'password':this.password}).then(res=>{
   localStorage.setItem('token',res.data.token)
   localStorage.setItem('loggedin',true)

   if(res.data.isClient)
   {
      console.log('Logged IN Successfully')
       this.$router.push('/client').then(res=>console.log('Logged IN Successfully')).catch(err=>res=>console.log(err))
    }else{
      this.txt="You are not Authorize to Login Here"
      this.snackbar=true
    }

  })
  .catch(err=>{
   // console.log(err)
   this.txt=err.response.data.status
   this.snackbar=true;
    })
 
  }



        }
}
</script>
<style scoped>

</style>