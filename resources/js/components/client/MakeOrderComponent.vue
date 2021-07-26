<template>
<v-container class="grey lighten-5">
  
    <v-row
      class="mb-12"
  
      no-gutters
    >
      <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="yellow darken-2"
      ></v-progress-linear>
      
      <v-col md="auto">
 
   
      </v-col>
   
    </v-row>
<v-row no-gutters>
      <v-col cols="9" xs="4">
        <div
          class="pa-2 text-h6">
         Date: {{design.created_at | formatDate }}
        </div>
      </v-col>
      <v-col cols="3">
        <v-btn tile color="lime" x-large @click="sendmail(design.id)">Make Payment $20</v-btn>
      </v-col>
</v-row><v-row>
      <v-col cols="12">
        <v-card flat>
           <v-card-text>
            <v-container fluid>
              <h5 class="text-h6">Requirements</h5>
        <v-textarea
          solo
          label="Description"
          :value=design.description
          disabled
        ></v-textarea>

         <h5 class="text-h6">Estimated Budget</h5>
          <p>{{ design.budget}} $</p>
           <v-col
            cols="12"
            sm="4"
            md="4"
          >
            <v-checkbox
                :input-value=design.isdigitizing
                label="Embroidery"
                disabled
            ></v-checkbox>
              <v-checkbox
               :input-value=design.isvector
                label="Vector"
                  disabled
                  >
                </v-checkbox>
           </v-col>
            <v-col
            cols="12"
            sm="4"
            md="4"
          >
          <h5 class="text-h6">Attached Files</h5>
           <v-list>
            <v-list-item  
              v-for="file in design.source_files" :key=file.id
                    >

           
             <v-list-item-avatar v-if="file.filename.includes('jpg') || file.filename.includes('png') || file.filename.includes('jpeg') || file.filename.includes('JPG') ">
                <v-img
            :src="file.filepath"
                ></v-img>
        </v-list-item-avatar>
       <v-list-item-avatar v-else >
         <v-icon large>mdi-attachment</v-icon>
       </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title v-text="file.filename"></v-list-item-title>
        </v-list-item-content>
        
          <v-btn tile color="lime" :href=file.filepath  :download=file.filename target="_blank" ><v-icon>
        mdi-download
      </v-icon></v-btn>
      
                

          


     
      </v-list-item>
    </v-list>
          
          </v-col>
            </v-container>
           </v-card-text>
        </v-card>
      </v-col>
         </v-row>
  

   


 <v-snackbar
      :timeout="5000"
      :value=snackbar
      absolute
      centered
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
        loading:false,
        design: {},
        
        errortext:'',
        snackbar:false,
         path:'/digitizingplace/public/api/',
      }
    },
    created () {
  
    this.initialize();
    },

    methods:{

      sendmail(e){
             
        axios.post(this.$apipath+'design/sendremainder?id='+e).then(res=>{

         
                   this.loading=false
                    this.snackbar=true
                    this.errortext=res.data.message       

  })
  .catch(err=>{
  
    
   this.snackbar=true
 this.errortext=err.data.message
 
    })



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
           this.loading = true;
            return response;
          },  (error) => {
           this.loading = false
            return Promise.reject(error);
          });
        
        axios.get(this.$apipath+'design/'+this.$route.query.id).then(res=>{
           
            this.design=res.data.design
           
           console.log(res.data.design)
            this.loading=false

   //localStorage.setItem('token',res.data.token)
   //localStorage.setItem('loggedin',true)


  })
  .catch(err=>{
   // console.log(err)
    
   this.snackbar=true
 this.errortext=err.response.message
 
    })
        },



  

      
    }


  }
</script>
<style scoped></style>