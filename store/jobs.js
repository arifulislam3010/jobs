
export const state = ()=>({
    all_jobs_category : [],
})

export const mutations = ({
    all_jobs_category(state,value)
    {
        state.all_jobs_category = value;
    }
})

export const actions =({
    async job_category ({ commit}) {
        try {
        //   commit('loading',true);
        await this.$axios.get('api/get-desired-job-tree').then(response => {
            console.log(response.data);
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
})