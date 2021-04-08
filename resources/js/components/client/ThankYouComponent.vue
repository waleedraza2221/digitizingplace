<template>

 <v-container  class="fill-height grey lighten-5"
        fluid >
    <div class="text-h4">{{ message }}</div>
   <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="yellow darken-2"
        
      ></v-progress-linear>

</v-container>
</template>
<script>
export default {
    mounted() {
            console.log('Thank you Compound mounted.')
        },

    data: () => ({
      
      loading:true,
     message:'Thank you for the Payment :) Please Wait While your transaction is Processing...',
 

    

    }),


  created () {
  
    this.initialize();
    console.log(this.$route.query);
   
 
    },


     methods: {



//?refno=143134607&total=50&total-currency=USD&signature=2d0adaeec37b2df97841e01d41baf2e0c59125de416ec8093636adb43335d79e
  
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

 axios.post(this.$apipath+'users/savepaymentinfo',{params:this.$route.query}).then(res=>{
   
//X-Avangate-Authentication: code="{VENDOR_CODE}" date="{REQUEST_DATE_TIME}" hash="{HASH}"
   
//https://api.2checkout.com/rest/6.0

this.$router.push('/client').then(res=>console.log('Logged IN Client Successfully')).catch(err=>res=>console.log(err))


  })
  .catch(err=>{
  
    alert('Please Contact Support at admin@digitizingplace.com');

    })
 





     
      }


 


 

  }
 



}



</script>
<style scoped>

</style>