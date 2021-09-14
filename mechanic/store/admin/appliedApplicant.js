
export const state = () => ({
    list:'',
    lists:{},
    lists2:'',
    errors:'',
    geterrors:'',
    loading:false,
  })
  export const getters = {
    list(state){
        return state.list
    },
    lists2(state){
      return state.lists2
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
        state.lists.data.unshift(data);
        if(state.lists.data.length>6){
          state.lists.data.pop();
        }
    },
    update(state,data) {
      state.lists.data.splice(data.index,0,data.list)
      state.lists.data.splice(data.index+1,1)
    },
    add2(state,data) {
      state.lists2.data.unshift(data);
      if(state.lists2.data.length>6){
        state.lists2.data.pop();
      }
    },
    get(state,lists) {
      state.lists = lists;
    },
    get2(state,lists) {
      state.lists2 = lists;
    },
    after_remove(state,index) {
      state.lists.data.splice(index,1)
    },
    after_remove2(state,index) {
      state.lists2.data.splice(index,1)
    }
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },
    async add ({ commit},data) {
      try {
      await this.$axios.put('contacts/gallery-info',data).then(response => {
          commit('add',response.data);
          this.$notify.success({
            title: 'Add',
            message: 'Added Successfully'
          });
      })
      .catch(error => {
          console.log(error)
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {

      }
    },async update ({ commit},data) {
      try {
      await this.$axios.post('api/update/applyed-apllicant',data).then(response => {
          console.log(data)
          commit('update',{list:response.data,index:data.index});
          this.$notify.success({
            title: 'Update',
            message: 'Updated Successfully'
          });
      })
      .catch(error => {
          console.log(error)
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {

      }
    },
    async add2 ({ commit},data) {
      try {
      await this.$axios.put('contacts/gallery-info',data).then(response => {
          commit('add2',response.data);
          this.$notify.success({
            title: 'Add',
            message: 'Added Successfully'
          });
      })
      .catch(error => {
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
        
      } catch (error) {

      }
    },
    async get ({commit},data) {
      try {
        await this.$axios.post('api/get/applyed-apllicant?page='+ data.page,data).then(response => {
          commit('get',response.data);
      })
      .catch(error => {
      });
        
      } catch (error) {
      }
    },
    async get2 ({commit},data) {
      try {
        await this.$axios.post('api/get-gallery?page='+ data.page,data).then(response => {
          commit('get2',response.data);
      })
      .catch(error => {
      });
        
      } catch (error) {
      }
    },
    async remove ({commit},data) {
      try {
        await this.$axios.get('contacts/gallery-delete/'+data.id).then(response => {
          commit('after_remove',data.index);
          this.$notify.success({
            title: 'Removed',
            message: 'Removed Succesfully'
          });
        })
        .catch(error => {
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
    async remove2 ({commit},data) {
      try {
        await this.$axios.get('contacts/gallery-delete/'+data.id).then(response => {
          commit('after_remove2',data.index);
          this.$notify.success({
            title: 'Removed',
            message: 'Removed Succesfully'
          });
        })
        .catch(error => {
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
  }
  