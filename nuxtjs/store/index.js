export const state = () => ({
    counter: 0,
  })
  
export const mutations = {
    increment (state) {
        state.counter++
    }
}


export const actions = {
    // nuxtServerInit is called by Nuxt.js before server-rendering every page
    nuxtServerInit ({ commit }, { req }) {
      // if (req.session && req.session.authUser) {
      //   commit('SET_USER', req.session.authUser)
      // }
    },
    async getToken({ commit }){
      return false;
    },
    async initial_call ({ commit }, { username, password }) {
      
        // alert('5');
      try {
        // alert('6');
        // const { data } = await axios.post('/api/login', { username, password })
        // commit('SET_USER', data)
      } catch (error) {
        // alert('7');
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