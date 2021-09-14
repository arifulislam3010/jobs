export const state = () => ({
    list:'',
    lists:{},
    agency_info:{},
    applicant_info:{},
    all_statistics:'',
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
    agency_info(state){
      return state.agency_info
    },
    applicant_info(state){
      return state.applicant_info
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
    all_statistics(state){
    	return state.all_statistics
    }
  }
  
  export const mutations = {
    
    get(state,lists) {
      state.lists = lists;
    },
    agencyInfo(state,lists) {
      state.agency_info = lists;
    },
    applicantInfo(state,lists) {
      state.applicant_info = lists;
    },
    empty(state){
      state.lists = {data:[]}
    },

    getAllStatistics(state,all_statistics) {
      state.all_statistics = all_statistics;
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
    
    async get ({commit},data) {
      try {
        commit('loading',true);
      await this.$axios.get('api/dashboardstatistics/all-data').then(response => {
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

    async getAllStatistics ({commit},data) {
      try {
      	var start_date = (data.applicantInfoMainDate.start)?data.applicantInfoMainDate.start:undefined;
        var end_date = (data.applicantInfoMainDate.end)?data.applicantInfoMainDate.end:undefined;
        var division_id = (data.division_id != undefined)?data.division_id:undefined;
        var district_id = (data.district_id != undefined)?data.district_id:undefined;
        commit('loading',true);
      await this.$axios.get('api/dashboardstatistics/all-data-statistics?'+(division_id!=undefined?'&division_id='+division_id:'')+(district_id!=undefined?'&district_id='+district_id:'')+(start_date!=undefined?'&start='+start_date:'')+(end_date!=undefined?'&end='+end_date:'')).then(response => {
          commit('getAllStatistics',response.data);
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
    async getRepot ({commit},data){
      await this.$axios.get('api/contact/report?page='+data.page+'&division_id='+data.division_id+'&district_id='+data.district_id+'&start_date='+data.start_date+'&end_date='+data.end_date+'&role_id='+data.role_id+'&status='+data.status).then(response => {
        console.log(response)  
        commit('get',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_geterrors',error.response.data)
          commit('loading',false);
      });
    },
    async agencyInfo ({commit}){
      await this.$axios.get('api/contact/agencyinfo').then(response => {
     
        commit('agencyInfo',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_geterrors',error.response.data)
          commit('loading',false);
      });
    },
    async applicantInfo ({commit}){
      await this.$axios.get('api/contact/applicantinfo').then(response => {
     
        commit('applicantInfo',response.data);
          commit('loading',false);
      })
      .catch(error => {
          commit('set_geterrors',error.response.data)
          commit('loading',false);
      });
    }
  }
  