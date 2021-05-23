
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
      state.lists.splice(data.index,0,data.list)
      state.lists.splice(data.index+1,1)
    },
    get(state,lists) {
      state.lists = lists;
    },
    after_remove(state,index) {
      state.lists.splice(index,1)
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
      try {
        commit('loading',true);
      await this.$axios.post('api/post',data).then(response => {
          commit('add',response.data);
          commit('loading',false);
          this.$notify.success({
            title: 'Add',
            message: 'Added Successfully'
          });
      })
      .catch(error => {
        commit('set_errors',error.response.data)
        commit('loading',false);
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {

      }
    },
    async statusUpdate({ commit},data) {
      try {
        commit('loading',true);
      await this.$axios.get('api/post/update-status/'+data.id+'/'+data.status).then(response => {
        let responseData = {index:data.index,list:response.data};
        commit('update',responseData);
        commit('loading',false);
        this.$notify.success({
          title: 'Update',
          message: 'Updated Successfully'
        });
      })
      .catch(error => {
        commit('set_errors',error.response.data)
        commit('loading',false);
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      }
    },
    async update ({ commit},data) {
      try {
        commit('loading',true);
      await this.$axios.put('api/post/'+data.list.id,data.list).then(response => {
        let responseData = {index:data.index,list:response.data};
        commit('update',responseData);
        commit('loading',false);
        this.$notify.success({
          title: 'Update',
          message: 'Updated Successfully'
        });
      })
      .catch(error => {
        commit('set_errors',error.response.data)
        commit('loading',false);
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      }
    },
    async get ({commit},data) {
      try {
      await this.$axios.get('api/post/list/'+data.type).then(response => {
        commit('get',response.data);
      })
      .catch(error => {
          commit('loading',false);
      });
        
      } catch (error) {
          commit('loading',false);
      }
    },
    async remove ({commit},data) {
      try {
        commit('loading',true);
        await this.$axios.get('api/post/delete/'+data.id).then(response => {
          commit('after_remove',data.key);
          commit('loading',false);
          this.$notify.success({
            title: 'Removed',
            message: 'Removed Succesfully'
          });
        })
        .catch(error => {
          commit('set_geterrors',error.response.data)
          commit('loading',false);
          this.$notify.error({
            title: 'Error',
            message: 'Something is wrong. Please try again'
          });
        });
      } catch (error) {
        commit('set_geterrors',error)
        commit('loading',false);
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      }
    },
  
  }
  