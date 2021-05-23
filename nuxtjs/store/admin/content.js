
export const state = () => ({
    list:'',
    lists:'',
    errors:'',
    geterrors:'',
    loading:false,
  })
  export const getters = {
    list(state){
        return state.list
    },
    lists(state){
      return state.lists
    },
    errors(state){
      return state.errors
    },
    geterrors(state){
      return state.geterrors
    },
    loading(state){
      return state.loading
    },
  }
  
  export const mutations = {
    add(state,data) {
      state.lists.unshift(data);
    },
    update(state,data) {
      state.lists[data.index] = data.list;
    },
    get(state,lists) {
      state.lists = lists;
    },
    loading(state,loading) {
      state.loading = loading;
    },
    set_errors(state,errors) {
      state.errors = errors;
    },
    set_geterrors(state,geterrors) {
      state.geterrors = geterrors;
    },
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },
    async add ({ commit},data) {
      console.log(data);
      try {
        commit('loading',true);
      await this.$axios.post('contacts',data).then(response => {
          commit('add',response.data);
          commit('loading',false);
          this.$notify.success({
            title: 'Add',
            message: 'Succesfully Add'
          });
      })
      .catch(error => {
          commit('set_errors',error.response.data)
          commit('loading',false);
          this.$notify.error({
            title: 'Error',
            message: 'Some Thing Probelm'
          });
      });
        
      } catch (error) {

      }
    },
    async update ({ commit},data) {
      console.log(data);
      try {
        commit('loading',true);
      await this.$axios.put('api/user/'.data.list.id,data.list).then(response => {
           let responseData = {index:data.index,list:response.data};
          commit('update',responseData);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_errors',error.response.data)
          commit('loading',false);
      });
        
      } catch (error) {

      }
    },
    async get ({commit},data) {
      
      try {
        commit('loading',true);
      await this.$axios.get('/api/contacts').then(response => {
          commit('get',response.data);
          console.log(response.data);
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
  