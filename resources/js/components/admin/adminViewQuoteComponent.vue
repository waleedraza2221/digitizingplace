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
    <v-row justify="center">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Send Quote
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="headline">Quote Form</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-form    
                ref="form">
           
              <v-col
                cols="12"
              >
                <v-text-field
                  label="Amount in $"
                  required
                ></v-text-field>

                     <v-textarea
          outlined
          required
          name="input-7-4"
          label="Description"
          value=""
          :rules="descriptionRules"
          v-model="description"
        
        ></v-textarea>
              
                <input hidden v-model="design_id" />
              </v-col>
               </v-form>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Close
          </v-btn>
          <v-btn
            color="blue darken-1"
            text
            @click="dialog = false"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
<v-row no-gutters>
      <v-col cols="9" xs="4">
        <div
          class="pa-2 text-h6">
         Date: {{design.created_at | formatDate }}
        </div>
      </v-col>
    
</v-row>
<v-row>
  <h4>Client Details</h4>

  <v-col cols="12">
<v-simple-table>
    <template v-slot:default>
    
      <tbody>
        <tr>
          <th>Name</th>
          <td>{{ design.user.name }}</td>
        </tr>
         <tr>
          <th>Email</th>
          <td>{{ design.user.email }}</td>
        </tr>
         <tr>
          <th>Phone</th>
          <td>{{ design.user.phone }}</td>
        </tr>
         <tr>
          <th>Balance</th>
          <td>{{ design.user.balance }}</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>



  </v-col>
</v-row>

<v-row>
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

         <h5 class="text-h6">Client Budget</h5>
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
        dialog:false,
        loading:false,
        design: {},
        design_id:0,
        description:'',
        amount:0,
        errortext:'',
        snackbar:false,
         path:'/digitizingplace/public/api/',
      }
    },
    created () {
  
    this.initialize();
    },

    methods:{

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
     
        axios.post(this.$apipath+'design/viewquote',{'id':this.$route.query.id}).then(res=>{
           
            this.design=res.data.designs
          this.design_id = res.data.designs.id
            this.loading=false


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