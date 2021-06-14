// import axios from 'axios'
// Vue.use(Auth)
export const state = () => ({
  registerNotification:'',
  loginNotification:'',
  authUser:'',
  isAuthenticated:false,
})

export const mutations = {
  SET_USER (state, user) {
    state.authUser = user;
    state.isAuthenticated = true;
  },
  SET_LOGIN_NOTIFICATION(state,data) {
    state.loginNotification = data
  },
  SET_REGISTER_NOTIFICATION(state,data) {
    state.registerNotification = data
  },
}

export const actions = {
  // nuxtServerInit is called by Nuxt.js before server-rendering every page
  nuxtServerInit ({ commit }, { req }) {
    // if (req.session && req.session.authUser) {
    //   commit('SET_USER', req.session.authUser)
    // }
  },
  async login ({ commit},data) {
    try {
    
    await this.$axios.post('login',data).then(response => {
        localStorage.setItem('access_token',response.data.access_token)
        localStorage.setItem('expires_in',response.data.expires_at)
        localStorage.setItem('isAuthenticated',true)
        console.log(response.data.access_token);
        this.$axios.defaults.headers.common["Authorization"] = 'Bearer '+ response.data.access_token;
        commit('SET_USER',response.data.user)
        // resolve(response)
    })
    .catch(error => {
        commit('SET_LOGIN_NOTIFICATION',error.response.data)
        // reject(error)
    });
      
    } catch (error) {
      // if (error.response && error.response.status === 401) {
      //   throw new Error('Bad credentials')
      // }
      // throw error
    }
  },

  async logout ({ commit }) {
    // await axios.post('/api/logout')
    // commit('SET_USER', null)
  }

}
