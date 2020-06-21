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
                color="error"
                dark
                flat
              >
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
            
              </v-toolbar>
              <v-card-text>
                 <v-progress-linear
                    :active="loading"
                    :indeterminate="loading"
                     absolute
                      top
                      color="deep-purple accent-4"
                  ></v-progress-linear>
                <v-form  ref="form"
                       v-model="valid"
                  >
                  <v-text-field
                    label="Login"
                    name="login"
                    v-model="email"
                    :rules="emailRules"
                    prepend-icon="mdi-account"
                    required
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    v-model="password"
                    name="password"
                     :rules="passwordRules"
                    prepend-icon="mdi-lock"
                    type="password"
                    required
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="error"  :disabled="!valid" @click="login">Login</v-btn>
              </v-card-actions>
            </v-card>
             <v-snackbar
      v-model="snackbar"
    >
      {{ text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="pink"
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
export default{

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
    text:'',
      valid: true,
  }
},
methods:{
  
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
    axios.post('/digitizingplace/public/api/login',{'email':this.email,'password':this.password}).then(res=>{
   localStorage.setItem('token',res.data.token)
   localStorage.setItem('loggedin',true)
   console.log('Logged IN Successfully')
   this.$router.push('/admin').then(res=>console.log('Logged IN Successfully')).catch(err=>res=>console.log(err))
  })
  .catch(err=>{
   // console.log(err)
   this.text=err.response.data.status
   this.snackbar=true;
    })
 
  }
}

}
</script>
<style scoped>

</style>