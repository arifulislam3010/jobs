
export const state = () => ({
    lists_a:'',
    lists_sa:'',
    errors_a:'',
    errors_sa:'',
    geterrors_a:'',
    geterrors_sa:'',
    loading_a:false,
    loading_sa:false,
  })
  export const getters = {
    lists_a(state){
      return state.lists_a
    },
    lists_sa(state){
        return state.lists_sa
    },
    errors_a(state){
      return state.errors_a
    },
    errors_sa(state){
      return state.errors_sa
    },
    geterrors_a(state){
      return state.geterrors_a
    },
    geterrors_sa(state){
      return state.geterrors_sa
    },
    loading_a(state){
      return state.loading_a
    },
    loading_sa(state){
      return state.loading_sa
    },
  }
  
  export const mutations = {
    add(state,data) {
      state.lists.unshift(data);
    },
    update(state,data) {
      state.lists[data.index] = data.list;
    },
    get_a(state,lists) {
      state.lists_a = lists;
    },
    get_sa(state,lists) {
      state.lists_sa = lists;
    },
    loading_a(state,loading) {
      state.loading_a = loading;
    },
    loading_sa(state,loading) {
      state.loading_a = loading;
    },
    set_errors_a(state,errors) {
      state.errors_a = errors;
    },
    set_geterrors_a(state,geterrors) {
      state.geterrors_a = geterrors;
    },
    set_errors_sa(state,errors) {
        state.errors_sa = errors;
    },
    set_geterrors_sa(state,geterrors) {
        state.geterrors_sa = geterrors;
    },
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },
    async add ({ commit},data) {
      console.log(data);
      try {
        commit('loading',true);
      await this.$axios.post('api/role',data).then(response => {
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
      await this.$axios.put('api/role/',data.list).then(response => {
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
    async get_a ({commit},data) {
      try {
        commit('loading_a',true);
      await this.$axios.get('api/frontend/area').then(response => {
          commit('get_a',response.data);
          console.log(response.data);
          commit('loading_a',false);
      })
      .catch(error => {
          commit('set_a',error.response.data)
          commit('loading_a',false);
      });
        
      } catch (error) {
          commit('set_geterrors_a',error)
          commit('loading_a',false);
      }
    },
    async get_sa ({commit},id) {
        try {
          commit('loading_sa',true);
        await this.$axios.get('api/frontend/subarea/'+id).then(response => {
            commit('get_sa',response.data);
            console.log(response.data);
            commit('loading_sa',false);
        })
        .catch(error => {
            commit('set_geterrors_sa',error.response.data)
            commit('loading_sa',false);
        });
          
        } catch (error) {
            commit('set_geterrors_sa',error)
            commit('loading_sa',false);
        }
    },
  
  }
  