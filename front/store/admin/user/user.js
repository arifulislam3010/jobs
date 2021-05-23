
export const state = () => ({
  list: '',
  lists: {},
  errors: '',
  geterrors: '',
  loading: false,
  applicants: '',
  modal:false
})
export const getters = {
  list(state) {
    return state.list
  },
  lists(state) {
    return state.lists
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
    state.lists.data.unshift(data);
  },
  update(state, data) {
    state.lists.data.splice(data.index,0,data.list)
    state.lists.data.splice(data.index+1,1)
  },
  delete(state, data) {
    state.lists.data.splice(data.index, 1);
  },
  get(state, lists) {
    state.lists = lists;
  },
  loading(state, loading) {
    state.loading = loading;
  },
  set_errors(state, errors) {
    state.errors = errors;
  },
  set_geterrors(state, geterrors) {
    state.geterrors = geterrors;
  },
  modal(state, payload) {
    state.modal = payload;
  },
}

export const actions = {
  nuxtServerInit({ commit }, { req }) {
  },
  async add({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.post('contacts', data).then(response => {
        commit('add', response.data);
        console.log(response.data)
        commit('modal', false);
        commit('loading', false);
        this.$notify.success({
          title: 'Add',
          message: 'Succesfully Add'
        });
      })
        .catch(error => {
          commit('set_errors', error.response.data.errors)
          commit('modal', true);
          this.$notify.error({
            title: 'Error',
            message: 'Some Thing Probelm'
          });
        });

    } catch (error) {

    }
  },
  
  async statusUpdate({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.post('api/contacts/status/update',data).then(response => {
        commit('loading', false);
        let responseData = { index: data.index, list: response.data };
        commit('update', responseData);
        this.$notify.success({
          title: 'Update',
          message: 'Succesfully Update'
        });
      })
        .catch(error => {
          commit('set_errors', error.response.data)
          commit('loading', true);
        });

    } catch (error) {
    }
  },
  async update({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.put('contacts/', data.list).then(response => {
        let responseData = { index: data.index, list: response.data };
        commit('update', responseData);
        commit('modal', false);
        this.$notify.success({
          title: 'Update',
          message: 'Succesfully Update'
        });
      })
        .catch(error => {
          commit('set_errors', error.response.data.errors)
          commit('modal', true);
        });

    } catch (error) {
    }
  },
  async delete({ commit }, data) {
    try {
      await this.$axios.delete('contacts/' + data.id).then(response => {
        let deleteData = { index: data.key, id: data.id };
        commit('delete', deleteData);
        this.$notify.success({
          title: 'Delete',
          message: 'Succesfully Update'
        });
      })
        .catch(error => {
          commit('set_errors', error.response.data)
          commit('loading', false);
        });

    } catch (error) {
    }
  },
  async get({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.get('/api/contacts?division_id='+data.division_id+'&district_id='+data.district_id+'&upozila_id='+data.upozila_id+'&search='+data.search+'&migrate='+data.migrate+'&migrate_date='+data.migrate_date+'&type='+data.type+'&limit='+data.limit+'&page='+data.page).then(response => {
        
        commit('get', response.data);
        commit('loading', false);
      })
        .catch(error => {
          commit('loading', false);
        });

    } catch (error) {
      commit('loading', false);
    }
  },

  async getEditor({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.get('/api/contacts/editor?role_id='+data.role_id).then(response => {
        commit('get', response.data);
        commit('loading', false);
      })
        .catch(error => {
          commit('set_geterrors', error.response.data)
          commit('loading', false);
        });

    } catch (error) {
      commit('set_geterrors', error)
      commit('loading', false);
    }
  },
  async get2({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.get('/api/contacts/finacial-training?role_id='+data.role_id+'&page='+data.page).then(response => {
        commit('get', response.data);
        commit('loading', false);
      })
        .catch(error => {
          commit('set_geterrors', error.response.data)
          commit('loading', false);
        });

    } catch (error) {
      commit('set_geterrors', error)
      commit('loading', false);
    }
  },
  async getAgency({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.get('/api/contacts/agency').then(response => {
        commit('get', response.data);
        commit('loading', false);
      })
        .catch(error => {
          commit('set_geterrors', error.response.data)
          commit('loading', false);
        });

    } catch (error) {
      commit('set_geterrors', error)
      commit('loading', false);
    }
  },
  async getApplicant({ commit }, data) {
    try {
      commit('loading', true);
      await this.$axios.get('/api/contacts/applicant').then(response => {
        commit('get', response.data);
        commit('loading', false);
      })
        .catch(error => {
          commit('set_geterrors', error.response.data)
          commit('loading', false);
        });

    } catch (error) {
      commit('set_geterrors', error)
      commit('loading', false);
    }
  },

}
