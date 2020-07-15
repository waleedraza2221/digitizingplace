<template>

 <v-container
       
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
            <v-card 
             
             >
              <v-toolbar
                
                
                flat
              >
                <v-toolbar-title>Quick Chat</v-toolbar-title>
                <v-spacer></v-spacer>
              
              </v-toolbar>
              <v-card-text  >
                     <iframe style="width:100%; height:100%;" src="https://tawk.to/chat/5ebb15a28ee2956d73a08954/default"></iframe>
              
              </v-card-text>
           
            </v-card>
          </v-col>
        </v-row>

      </v-container>
    


</template>
<script>
export default {
    mounted() {
            console.log('Contact Us Component mounted.')
        }
}
</script>
<style scoped>

</style>