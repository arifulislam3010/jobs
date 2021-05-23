
export const state = () => ({
    list:'',
    lists:{},
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
      state.lists.data.unshift(data);
    },
    update(state,data) {
      state.lists.data.splice(data.index,0,data.list)
      state.lists.data.splice(data.index+1,1)
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
    after_remove(state,index) {
      // console.log(index);
      state.lists.data.splice(index,1)
    },
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },
    async add ({ commit},data) {
      // console.log(data)
      let fdata = new FormData()
      fdata.append('title',data.title);
      fdata.append('file',data.file);
      fdata.append('type',data.type)
      fdata.append('change_image',data.change_image)
      if(data.content_category) fdata.append('content_category',data.content_category)
      try {
        commit('loading',true);
      await this.$axios.post('api/contentmanager/store?id='+data.id,fdata).then(response => {
        if(data.id){
          commit('update',{index:data.index,list:response.data});
        }
        else{
          commit('add',response.data);
        }
          
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
      await this.$axios.post('/api/contentmanager?page='+data.page,data).then(response => {
          commit('get',response.data);
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
    async removeContent ({commit},data) {
      await this.$axios.delete('/api/contentmanager/delete/'+data.id).then(response => {
        this.$notify.success({
          title: 'Removed',
          message: 'Removed Succesfully'
        });
        commit('after_remove',data.key);
      })
      .catch(error => {
        this.$notify.error({
          title: 'Error',
          message: 'Something is wrong. Please try again'
        });
      });
    },
  
  }
  