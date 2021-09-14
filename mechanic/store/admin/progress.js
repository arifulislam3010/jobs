
export const state = () => ({
    progress:0,
  })
  export const getters = {
    get_rogress(state){
        return state.progress
    },
  }
  export const mutations = {
    addProgress(state,data) {
        state.progress = data
    },
  }
  
 
  