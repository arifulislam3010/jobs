<template>
    <div id="wrapper" class="d-flex flex-column" style="background: #f4f5f7;">
          <div style="background: #fff;">
            <TopBar></TopBar>
            <header class="header-global">
                <starter-header></starter-header>
            </header>
          </div>
          <!-- <nuxt /> -->
          <main class="flex-fill position-relative main-block">
            <nuxt />
          </main>
          <footer class="footer">
              <starter-footer></starter-footer>
          </footer>
    </div>
</template>

<script>
import StarterHeader from "~/components/argon-layout/starter/StarterHeader";
import TopBar from "~/components/argon-layout/starter/TopBar";
import StarterFooter from "~/components/argon-layout/starter/StarterFooter";
import { mapState,mapMutations,mapGetters,mapActions } from 'vuex'
export default {
  components: {
    StarterHeader,
    StarterFooter,
    TopBar
  },
  data () {
    return {
      initialLoading:true,
    }
  },
  beforeRouteEnter (to, from, next) {
      this.initialCall();
    },
  mounted(){
    // this.initialCall();
  },
  methods: {
     async initialCall () {
      if(localStorage.getItem('access_token')!=null){
        var getuser = '';
        this.$axios.defaults.headers.common['Authorization'] ='Bearer '+localStorage.getItem('access_token');
        if(localStorage.getItem('isAuthenticated')){
          let Authenticated = false;
          await this.$axios.get('api/user/info').then(response => {
              console.log('a');
              this.initialLoading = false;
              Authenticated = true;
              this.$router.push({
                  path: $nuxt.$route.path
              });
              alert($nuxt.$route.path);
              this.$store.commit('admin/user/login/SET_USER',response.data,{ root: true });
          });
          if(!Authenticated){
              var authdata = {};
              var authdata = {};
              authdata= {
              grant_type:'client_credentials',
              client_id:1,
              client_secret:'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu',
              };

              await this.$axios.post('oauth/token',authdata).then(response => {
                this.initialLoading = false;
                localStorage.setItem('access_token',response.data.access_token)
                localStorage.setItem('expires_in',response.data.expires_in)
                localStorage.setItem('isAuthenticated',false)
                this.$axios.defaults.headers.common["Authorization"] = 'Bearer '+ response.data.access_token;
                
              });
          }
        }else{
          var token = localStorage.getItem('access_token')
          var expiration = localStorage.getItem('expires_in')
          
          if(Date.now() > parseInt(expiration)){
              var authdata = {};
              var authdata = {};
              authdata= {
              grant_type:'client_credentials',
              client_id:1,
              client_secret:'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu',
              };
    
              await this.$axios.post('oauth/token',authdata).then(response => {
                this.initialLoading = false;
                localStorage.setItem('access_token',response.data.access_token)
                localStorage.setItem('expires_in',response.data.expires_in)
                localStorage.setItem('isAuthenticated',false)
                axios.defaults.headers.common["Authorization"] = 'Bearer '+ response.data.access_token;
                // commit('ACCESS_TOKEN',response.data)
                // resolve(response)
            });
        }
      }
      }else{
         var authdata = {};
          var authdata = {};
          authdata= {
          grant_type:'client_credentials',
          client_id:1,
          client_secret:'VRWWp632lWT06LmATLddpJfiCSWKeehhS7bYBVXu',
          };

          await this.$axios.post('oauth/token',authdata).then(response => {
            localStorage.setItem('access_token',response.data.access_token)
            localStorage.setItem('expires_in',response.data.expires_in)
            localStorage.setItem('isAuthenticated',false)
            this.$axios.defaults.headers.common['Authorization'] = 'Bearer '+ response.data.access_token;
        });
      } 
    }
  }

};
</script>

<style>
body, #wrapper {
   min-height:100vh;
}
.main-block{
  /* overflow: initial */
background-color: #fff;
}
</style>
