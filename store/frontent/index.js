
export const state = () => ({
    list:'',
    sliders:'',
    appointments:'',
    stories:{},
    notices:{},
    news:{},
    downloads:{},
    errors:'',
    geterrors:'',
    users:'',
    user:'',
    post:{},
    loading:false
  })
  export const getters = {
    post(state){
        return state.post
    },
    list(state){
        return state.list
    },
    sliders(state){
      return state.sliders
    },
    appointments(state){
      return state.appointments
    },
    stories(state){
      return state.stories
    },
    notices(state){
      return state.notices
    },
    news(state){
      return state.news
    },
    downloads(state){
      return state.downloads
    },
    users(state){
      return state.users
    },
    user(state){
      return state.user
    },
    errors(state){
      return state.errors
    },
    geterrors(state){
      return state.geterrors
    },
    loading(state){
      return state.loading
    }
  }
  
  export const mutations = {
    add(state,data) {
      state.lists.unshift(data);
    },
    update(state,data) {
      state.lists[data.index] = data.list;
    },
    get_sliders(state,sliders) {
      state.sliders = sliders;
    },
    
    get_downloads(state,downloads) {
      state.downloads = downloads;
    },
    get_stories(state,stories) {
      state.stories = stories;
    },
    get_notices(state,notices) {
      state.notices = notices;
    },
    get_news(state,news) {
      state.news = news;
    },
    get_appointments(state,appointments) {
      state.appointments = appointments;
    },
    get_users(state,users) {
      state.users = users;
    },
    get_user(state,user) {
      state.user = user;
    },
    get_post(state,post) {
      state.post = post;
    },
    loading(state,loading) {
      state.loading = loading;
    },
    set_errors(state,errors) {
      state.errors = errors;
    },
    set_geterrors(state,geterrors) {
      state.geterrors = geterrors;
    }
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },

    async get_users ({ commit},data) {
      try {
        commit('loading',true);
      await this.$axios.post('api/frontend/users?page=' + data.page,data.data).then(response => {
          commit('get_users',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_errors',error.response.data)
          commit('loading',false);
      });
        
      } catch (error) {

      }
    },
    
    async get_downloads ({ commit},data) {
      try {
        commit('loading',true);
      await this.$axios.post('api/frontend/contents?page='+data.page,data).then(response => {
        commit('get_downloads',response.data);
        commit('loading',false);
      })
      .catch(error => {
        commit('set_errors',error.response.data)
        commit('loading',false);
      });
        
      } catch (error) {

      }
    },
    async get_stories ({ commit},data) {
      try {
        commit('loading',true);
        await this.$axios.post('api/frontend/posts?page=' + data.page,data.search).then(response => {
            commit('get_stories',response.data);
            commit('loading',false);
        })
        .catch(error => {
            commit('set_errors',error.response.data)
            commit('loading',false);
        });
      } catch (error) {

      }
    },
    async get_notices ({ commit},data) {
      try {
        commit('loading',true);
        await this.$axios.post('api/frontend/posts?page=' + data.page,data.search).then(response => {
            commit('get_notices',response.data);
            commit('loading',false);
        })
        .catch(error => {
            commit('set_errors',error.response.data)
            commit('loading',false);
        });
      } catch (error) {

      }
    },
    async get_news ({ commit},data) {
      try {
        commit('loading',true);
        await this.$axios.post('api/frontend/posts?page=' + data.page,data.search).then(response => {
            commit('get_news',response.data);
            commit('loading',false);
        })
        .catch(error => {
            commit('set_errors',error.response.data)
            commit('loading',false);
        });
      } catch (error) {

      }
    },
    async get_appointments ({ commit},data) {
      try {
        commit('loading',true);
        await this.$axios.post('api/frontend/posts?page=' + data.page,data).then(response => {
            commit('get_appointments',response.data);
            commit('loading',false);
        })
        .catch(error => {
            commit('set_errors',error.response.data)
            commit('loading',false);
        });
      } catch (error) {

      }
    },

    async get_post ({ commit},slug) {
      try {
        commit('loading',true);
      await this.$axios.get('api/frontend/post/details/'+slug).then(response => {
          commit('get_post',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_errors',error.response.data)
          commit('loading',false);
      });
        
      } catch (error) {

      }
    },
    
    async get_user ({ commit},id) {
      try {
        commit('loading',true);
      await this.$axios.get('api/frontend/user/'+id).then(response => {
          commit('get_user',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_errors',error.response.data)
          commit('loading',false);
      });
        
      } catch (error) {

      }
    },
    async get_sliders ({commit},data) {
      try {
        commit('loading',true);
      await this.$axios.post('api/frontend/contents',data).then(response => {
          commit('get_sliders',response.data.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_geterrors',error.response.data)
          commit('loading',false);
      });
        
      } catch (error) {
          commit('set_geterrors',error)
          commit('loading',false);
      }
    },
  
  }
  