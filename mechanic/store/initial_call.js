import axios from 'axios'

export const state = () => ({
    access_token:'',
    cv_status:false,
})

export const mutations = {
  ACCESS_TOKEN (state, user) {
    state.authUser = user
  },
  CV_STATUS_M(state,status) {
    state.cv_status=true;
  },
  CV_STATUS_M_hide(state,status) {
    state.cv_status=false;
  },
}

export const actions = {
  // nuxtServerInit is called by Nuxt.js before server-rendering every page
  nuxtServerInit ({ commit }, { req }) {
    // if (req.session && req.session.authUser) {
    //   commit('SET_USER', req.session.authUser)
    // }
  },
  async initial ({ commit }) {
    try {
      if(localStorage.getItem('access_token')!=null){
        var getuser = '';
        this.$axios.defaults.headers.common['Authorization'] ='Bearer '+localStorage.getItem('access_token');
        if(localStorage.getItem('isAuthenticated')){
          let Authenticated = false;
          await this.$axios.get('api/user/info').then(response => {
              console.log('a');
              
              this.$router.push({
                  path: $nuxt.$route.path
              })
              Authenticated = true;
              commit('admin/user/login/SET_USER',response.data,{ root: true });
          });
          if(!Authenticated){
            console.log('b');

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
                this.$axios.defaults.headers.common["Authorization"] = 'Bearer '+ response.data.access_token;
                
              });
          }
          console.log('c');
        }else{
          console.log('d');
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
    } catch (error) {
      if (error.response && error.response.status === 401) {
        throw new Error('Bad credentials')
      }
      throw error
    }
  },

  async logout ({ commit }) {
    // await axios.post('/api/logout')
    // commit('SET_USER', null)
  }

}
