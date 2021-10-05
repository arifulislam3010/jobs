
export const state = ()=>({
    all_jobs_category : [],
    job_owner_with_post:[],
    job_type:[],
    senarity_level_data:[]
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

    all_job_with_type(state,value)
    {
        state.all_job_type = value;
    },
    senarity_level_data_ok(state,value){
        state.senarity_level_data = value
    }

})
function timeout(ms) {
    return new Promise(resolve => setTimeout(resolve, ms))
  }
export const actions =({
    async all_job_type({commit}){
        //    await timeout(10000);
        try{

            await this.$axios.get('/job-category').then(response=>{
                console.log(response.data.data);
                    commit('all_job_with_type',response.data.data)
            }).catch(error =>{
                console.log(error)
            })
        }catch(error)
        {

        }
      },
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
      async senarity_level({commit}){
          try{
            // /seniority-level
            await this.$axios.get('/seniority-level').then(response => {
                // console.log(response.data.data)
                commit('senarity_level_data_ok',response.data.data);
                // commit('loading',false);
            })
            .catch(error => {
                // commit('set_errors',error.response.data)
                // commit('loading',false);
                console.log(error);
            });
          }catch(error){

          }
      }

})