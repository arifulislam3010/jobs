
export const state = () => ({
    list: '',
    divisions: {},
    districts: {},
    subdistricts: {},
    lists: {},
    errors: '',
    geterrors: '',
    loading: false,
    applicants: '',
    modal:false
  })
  export const getters = {
    lists(state) {
      return state.lists
    },
    divisions(state) {
      return state.divisions
    },
    subdistricts(state) {
      return state.subdistricts
    },
    districts(state) {
      return state.districts
    },
    errors(state) {
      return state.errors
    },
    geterrors(state) {
      return state.geterrors
    },
    loading(state) {
      return state.loading
    },
  }
  
  export const mutations = {
    add(state, data) {
      if(data.type == 'divisions'){
        state.divisions.data.unshift(data.list);
      }
      else if(data.type == 'districts'){
        state.districts.data.unshift(data.list);
      }
      else if(data.type == 'subdistricts'){
        state.subdistricts.data.unshift(data.list);
      }
      else{
        state.lists.data.unshift(data.list);
      } 
    },
    update(state, data) {
      console.log(data)
      if(data.type == 'divisions'){
        state.divisions.data.splice(data.index,0,data.list)
        state.divisions.data.splice(data.index+1,1)
      }
      else if(data.type == 'districts'){
        state.districts.data.splice(data.index,0,data.list)
        state.districts.data.splice(data.index+1,1)
      }
      else if(data.type == 'subdistricts'){
        state.subdistricts.data.splice(data.index,0,data.list)
        state.subdistricts.data.splice(data.index+1,1)
      }
      else{
        state.lists.data.splice(data.index,0,data.list)
        state.lists.data.splice(data.index+1,1)
      } 
    },
    delete(state, data) {
      if(data.type == 'divisions'){
        state.divisions.data.splice(data.index, 1);
      }
      else if(data.type == 'districts'){
        state.districts.data.splice(data.index, 1);
      }
      else if(data.type == 'subdistricts'){
        state.subdistricts.data.splice(data.index, 1);
      }
      else{
        state.lists.data.splice(data.index, 1);
      }
    },
    get(state, data) {
      if(data.type == 'divisions'){
        state.divisions = data.lists;
      }
      else if(data.type == 'districts'){
        state.districts = data.lists;
      }
      else if(data.type == 'subdistricts'){
        state.subdistricts = data.lists;
      }
      else{
        state.lists = data.lists;
      }
    }
  }
  
  export const actions = {
    nuxtServerInit({ commit }, { req }) {
    },
    async add({ commit }, data) {
      try {
        await this.$axios.post('api/dynamic/field', data).then(response => {
          let responseData = { type:data.type,list: response.data };
          commit('add', responseData);
          this.$notify.success({
            title: 'Add',
            message: 'Succesfully Add'
          });
        })
          .catch(error => {
            this.$notify.error({
              title: 'Error',
              message: 'Some Thing Probelm'
            });
          });
  
      } catch (error) {
  
      }
    },
    async update({ commit }, data) {
      try {
        await this.$axios.put('api/dynamic/field', data).then(response => {
          let responseData = { index: data.index-1,type:data.type,list: response.data };
          commit('update', responseData);
          this.$notify.success({
            title: 'Update',
            message: 'Succesfully Update'
          });
        })
          .catch(error => {
            commit('modal', true);
          });
  
      } catch (error) {
      }
    },
    async delete({ commit }, data) {
      try {
        await this.$axios.post('api/dynamic/field/delete',data).then(response => {
          let deleteData = { index: data.index,type:data.type, id: data.id };
          commit('delete', deleteData);
          this.$notify.success({
            title: 'Delete',
            message: 'Succesfully Update'
          });
        })
          .catch(error => {
            commit('loading', false);
          });
  
      } catch (error) {
      }
    },
    async get({ commit }, data) {
      try {
        await this.$axios.get('api/dynamic/field?type='+data.type+'&page='+data.page+'&limit='+data.limit).then(response => {
          let responseData = { type: data.type, lists: response.data };
          commit('get', responseData);
        })
        .catch(error => {
        });
  
      } catch (error) {
      }
    }
  
  }
  