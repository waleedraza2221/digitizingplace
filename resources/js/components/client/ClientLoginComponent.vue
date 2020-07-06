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
                <v-form>
                  <v-text-field
                    label="Login Email"
                    name="login"
                    prepend-icon="mdi-account"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                 <v-btn color="amber" @click="register">Register</v-btn>
                <v-btn color="amber">Login</v-btn>
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
    mounted() {
            console.log('Login Home Component mounted.')
        },

        methods: {
            register:function(){
                 this.$router.push('/client/register')
            }
        }
}
</script>
<style scoped>

</style>