
export const state = ()=>({
    all_jobs_category : [],
    job_owner_with_post:[],
})

export const mutations = ({
    all_jobs_category(state,value)
    {
        state.all_jobs_category = value;
    },

    job_owner_with_post(state,value)
    {
        state.job_owner_with_post = value;
    },
})

export const actions =({
    async job_category ({ commit}) {
        try {
        //   commit('loading',true);
        await this.$axios.get('api/get-desired-job-tree').then(response => {
            // console.log(response.data);
            commit('all_jobs_category',response.data);
            // commit('loading',false);
        })
        .catch(error => {
            // commit('set_errors',error.response.data)
            // commit('loading',false);
            console.log(error);
        });
          
        } catch (error) {
  
        }
      },
      async job_with_owner ({ commit}) {
        try {
        //   commit('loading',true);
        await this.$axios.get('api/frontend/top-post-owner').then(response => {
            commit('job_owner_with_post',response.data);
            // commit('loading',false);
        })
        .catch(error => {
            // commit('set_errors',error.response.data)
            // commit('loading',false);
            console.log(error);
        });
          
        } catch (error) {
  
        }
      },

})