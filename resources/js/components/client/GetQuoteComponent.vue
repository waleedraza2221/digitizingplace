<template>
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
            md="6"
           
          >
            <v-card>
              <v-toolbar
                
                
                flat
              >
                <v-toolbar-title>Get a Quote</v-toolbar-title>
                <v-spacer></v-spacer>
              
              </v-toolbar>
              <v-card-text>
           <v-progress-linear
           :active=" loading"
           :indeterminate="loading"
            color="amber"
      
            rounded
            height="6"
          ></v-progress-linear>
                <v-form    
                ref="form"
                v-model="valid">
                 <v-col cols="12"  >
               <v-file-input
                 @change="changefile"
                :rules="filesRules"
                 
                small-chips multiple label="Upload your Designs" ></v-file-input>
              </v-col>
              <v-row justify="space-around">
                
                   <v-checkbox readonly="" class="ma-4" v-model="digitizing" label="Digitizing"></v-checkbox>
                    <v-checkbox   class="ma-4" v-model="vector" label="Vector"></v-checkbox>
                
               </v-row>

                <v-col cols="12" >
          <v-text-field 
            v-model="budget"
             type="number"
            label="Your Budget $ (Optional)"
        
          ></v-text-field>
        </v-col>
               <v-col cols="12" >
        <v-textarea
          outlined
          required
          name="input-7-4"
          label="Description"
          value=""
          :rules="descriptionRules"
          v-model="description"
        
        ></v-textarea>
      </v-col>
           <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="amber" @click="upload">Send</v-btn>
              </v-card-actions>
                
                </v-form>
              </v-card-text>
           
            </v-card>
          </v-col>
        </v-row>

           <v-snackbar v-model="snackbar" >
               {{text}}
                <v-btn
                  color="error"
                  text
                  @click="snackbar = false"
                >
                  Close
                </v-btn>
              </v-snackbar>  
      </v-container>

</template>
<script>
export default {
    mounted() {
            console.log('Get Quote Component mounted.')
        },
         data: () => ({
             loading: false,
               snackbar: false,
               text:'',
           valid:true,
          description:'',
          budget:0,
         digitizing:true,
         vector:false,
         files:[],
        
        descriptionRules: [
        v => !!v || 'Description is required',
        v => (v && v.length >= 5) || 'Description must be greater than 5 characters',
      ],
          filesRules:[
              v => !!v || 'Files are required',

          ]
 



    }),
    methods:{
          changefile:function(e){
        //  console.log(e)
       let selectedFiles=e;
                if(!e.length){
                    return false;
                }
                for(let i=0;i<e.length;i++){
                    this.files.push(e[i]);
                }
                console.log(this.files);
  },
        	upload: function(){
        
        // Add a request interceptor
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

 if( this.$refs.form.validate()){
        

       let formData = new FormData();
         for(let i=0; i<this.files.length;i++){
                  formData.append('sourcefiles[]',this.files[i]);
                }

     // formData.append("sourcefiles", this.files)
       formData.append("description",this.description)
      //    formData.append("isvector",this.vector)
      //    formData.append("budget",this.budget)
       // console.log(formData)


          axios.post(this.$apipath+'design', formData)
          .then(res =>  {
          console.log(res.message);
            this.text =res.message;
            this.snackbar=true;
                    
          })
          .catch(err => {
            console.dir(err)
             this.text = "Error Inserting Record"
             this.snackbar=true
          })
        }

        
				
			}
   


    },
  




}
</script>
<style scoped>

</style>