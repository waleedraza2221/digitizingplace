<template>
<v-container class="grey lighten-5">
  
    <v-row
      class="mb-12"
  
      no-gutters
    >
      <v-progress-linear
        :active="loading"
        :indeterminate="loading"
        color="darken-2"
      ></v-progress-linear>
      
      <v-col md="auto">
             
         <div class="text-h4 mb-6 text-center">
       
       My Quotes
      
    </div>
 


      </v-col>
   
    </v-row>
    <v-row no-gutters>
     
      <v-col>
      
       <v-simple-table>
    
    <template v-slot:default>

      
      <thead>
        <tr>
          <th class="text-left">
            Date
          </th>
            <th class="text-left">
            Id
          </th>
           <th class="text-left">
            Estimate Budget $
          </th>
          <th class="text-left">
            Files Count
          </th>
           <th class="text-left">
            View
          </th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="item in designs"
          :key="item.id"
        >
          <td>{{  item.created_at | formatDate   }}</td>
          <td>{{  item.id   }}</td>
          <td>{{ item.budget }}</td>
          <td>{{ item.source_files.length }}</td>
          <td><v-btn
      tile
      @click="redirecttoget(item.id)"
    >
      <v-icon left>
        mdi-magnify-plus
      </v-icon>
      Open
    </v-btn></td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>
      </v-col>
     
    </v-row>
  </v-container>
 
</template>
<script>
  export default {
    data () {
      return {
        loading:false,
        designs: [],
         path:'/digitizingplace/public/api/',
      }
    },
    created () {
  
    this.initialize();
    },

    methods:{

      redirecttoget(e){

        this.$router.push('/admin/adminviewquote?id='+e)

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
        
        axios.post(this.$apipath+'design/getallawaitingquote').then(res=>{

            this.designs=res.data.designs
            this.loading=false


  })
  .catch(err=>{

    })
        }
      
    }


  }
</script>
<style scoped></style>