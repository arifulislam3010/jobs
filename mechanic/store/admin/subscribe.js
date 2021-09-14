
export const state = () => ({
    agencies:'',
    countries:'',
    jobs:'',
    languages:'',
    sub_agencies:{},
    sub_countries:{},
    sub_jobs:{},
    sub_languages:{},
  })
  export const getters = {
    agencies(state){
        return state.agencies
    },
    countries(state){
        return state.countries
    },
    jobs(state){
        return state.jobs
    },
    languages(state){
        return state.languages
    },
    sub_agencies(state){
        return state.sub_agencies
    },
    sub_countries(state){
        return state.sub_countries
    },
    sub_jobs(state){
        return state.sub_jobs
    },
    sub_languages(state){
        return state.sub_languages
    },
  }
  
  export const mutations = {
    set_agency(state,data){
        state.agencies = data;
    },
    set_country(state,data){
        state.countries = data;
    },
    set_job(state,data){
        state.jobs = data;
    },
    set_language(state,data){
        state.languages = data;
    },
    set_sub_agency(state,data){
        state.sub_agencies = data;
    },
    set_sub_country(state,data){
        state.sub_countries = data;
    },
    set_sub_job(state,data){
        state.sub_jobs = data;
    },
    set_sub_language(state,data){
        state.sub_languages = data;
    },
    after_unsubscribe(state,data) {
      if(data.type == 'agency'){
        state.sub_agencies.data.splice(data.index,1)
      }
      else if(data.type == 'country'){
        state.sub_countries.data.splice(data.index,1)
      }
      else if(data.type == 'language'){
        state.sub_languages.data.splice(data.index,1)
      }
      else if(data.type == 'job'){
        state.sub_jobs.data.splice(data.index,1)
      }
    }
  }
  
  export const actions = {
    nuxtServerInit ({ commit }, { req }) {
    },
    async getAgency ({ commit},page) {
      try {
      await this.$axios.get('subscribe/agency?page='+page).then(response => {
        commit('set_agency',response.data.agencies);
        commit('set_sub_agency',response.data.subscribe_agencies);
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
    async getCountry ({ commit},page) {
      try {
      await this.$axios.get('subscribe/country?page='+page).then(response => {
        commit('set_country',response.data.countries);
        commit('set_sub_country',response.data.subscribe_countries);
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
    async getLanguage ({ commit},page) {
      try {
      await this.$axios.get('subscribe/language?page='+page).then(response => {
        commit('set_language',response.data.languages);
        commit('set_sub_language',response.data.subscribe_languages);
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
    async getJob ({ commit},page) {
      try {
      await this.$axios.get('subscribe/job?page='+page).then(response => {
        commit('set_job',response.data.jobs);
        commit('set_sub_job',response.data.subscribe_jobs);
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
    async subscribe ({ commit},data) {
      try {
      await this.$axios.post('subscribe',data).then(response => {
        if(data.type == 'agency'){
          commit('set_agency',response.data.agencies);
          commit('set_sub_agency',response.data.subscribe_agencies);
        }
        else if(data.type == 'country'){
          commit('set_country',response.data.countries);
          commit('set_sub_country',response.data.subscribe_countries);
        }
        else if(data.type == 'language'){
          commit('set_language',response.data.languages);
          commit('set_sub_language',response.data.subscribe_languages);
        }
        else if(data.type == 'job'){
          commit('set_job',response.data.jobs);
          commit('set_sub_job',response.data.subscribe_jobs);
        }
        
        this.$notify.success({
          title: 'Subscribe',
          message: 'Subscribe Successfully'
        });
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
    async deleteSub({ commit},data) {
      try {
      await this.$axios.post('subscribe/delete',data).then(response => {
        if(data.type == 'agency'){
          let data2 = {index:data.index,type:data.type};
          commit('set_agency',response.data.agencies);
          commit('after_unsubscribe',data2);
        }
        else if(data.type == 'country'){
          let data2 = {index:data.index,type:data.type};
          commit('set_country',response.data.countries);
          commit('after_unsubscribe',data2);
        }
        else if(data.type == 'language'){
          let data2 = {index:data.index,type:data.type};
          commit('set_language',response.data.languages);
          commit('after_unsubscribe',data2);
        }
        else if(data.type == 'job'){
          let data2 = {index:data.index,type:data.type};
          commit('set_job',response.data.jobs);
          commit('after_unsubscribe',data2);
        }
        
        this.$notify.success({
          title: 'Unsubscribe',
          message: 'Unsubscribe Successfully'
        });
      })
      .catch(error => {
      });
        
      } catch (error) {

      }
    },
  
  }
  