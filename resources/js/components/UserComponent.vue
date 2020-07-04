<template>
<v-data-table item-key="name" class="elevation-1" 
:loading ="loading"
loading-text="Loading... Please wait"
 :headers="headers"
    :items="user"
    sort-by="calories"
   >


 <template v-slot:top>
      <v-toolbar flat color="dark">
        <v-toolbar-title>user Management System</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="error"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >Add New User</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="12" md="12">
                    <v-text-field color="error" required  v-model="editedItem.name" label="User Name"></v-text-field>
                  </v-col>

                  <!-- <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                  </v-col> -->
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="error darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="error darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="error" @click="initialize">Reset</v-btn>
    </template>
        <v-snackbar
      v-model="snackbar"
    >
     

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
</v-data-table>





</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      loading:false,
      snackbar:false,
      test:'',
      headers: [
        {
          text: '#',
          align: 'left',
          sortable: false,
          value: 'id',
        },
        { text: 'Name', value: 'name' },
        { text: 'Created At', value: 'created_at' },
        { text: 'Updated At', value: 'updated_at' },
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      user: [],
      editedIndex: -1,
      
      editedItem: {
          id:'',
        name: '',
        created_at:'',
        updated_at:'',
        
      },
      defaultItem: {
            id:'',
        name: '',
        created_at:'',
        updated_at:'',
        
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'New user' : 'Edit user'
      },
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
      

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

      axios.get(this.$apipath+'users',{})
        .then(res=>this.user=res.data.users)
        .catch(err=>{
            if(err.response.status==401)
            localStorage.removeItem('token');
            this.$router.push('/login');
            
            })
      }
,
      editItem (item) {
          //console.log(item);
        this.editedIndex = this.user.indexOf(item)
        //  console.log(this.editedIndex);
        this.editedItem = Object.assign({}, item)
       //  console.log(this.editedItem);
        this.dialog = true
      },

      deleteItem (item) {
          const index = this.user.indexOf(item)

          let isdeleted=confirm('Are you sure you want to delete this item?'+index)
          if(isdeleted){
               
            axios.delete(this.$apipath+'users/'+item.id,item.id)
            .then(res=>{
              this.text="Record Deleted Successfully!";
              this.snackbar=true
              this.user.splice(index, 1)
              
              })
          .catch(err=>{
            this.text="Error Deleting Record!";
              this.snackbar=true
            console.log(err.response)
            })
          }
          
        
    
      },

      close () {
        this.dialog = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
      },

      save () {
      
        if (this.editedIndex > -1) {
               // console.log(this.editedIndex)
               // console.log(this.editedItem.id)
               const ei=this.editedIndex
        
            axios.put(this.$apipath+'users/'+this.editedItem.id,{'name':this.editedItem.name})
            .then(res=> {
                // console.log(this.ei)
             this.text="Record Updated Successfully!";
             this.snackbar=true;
                // console.log(res.data.user)
                // console.log(res.data.user.id)
                // console.log(this.user[res.data.user.id-1])
 
                // console.log(this.user[this.editedIndex])
                //   console.log(this.user[this.editedItem.id])
                 Object.assign(this.user[ei], res.data.user)
            })
            .catch(err=>{
              
                this.text="Error Updating users!";
             this.snackbar=true;
              console.log(err)})
        //  Object.assign(this.user[this.editedIndex], this.editedItem)

        } else {
                axios.post(this.$apipath+'users',{'name':this.editedItem.name})
          .then(res=> {
             this.text="Record Added Successfully!";
             this.snackbar=true;
            this.user.push(res.data.user)
            
            
            
            })
          .catch(err=>{
              
                this.text="Error Adding users!";
             this.snackbar=true;
              console.log(err)})
         
        }
        this.close()
      },
    },
  }
</script>
<style scoped>

</style>