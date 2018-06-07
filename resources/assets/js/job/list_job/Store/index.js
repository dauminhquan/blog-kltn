import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        key_query: {},
        job_detail: {
        }
    },
    mutations:{
        updateKeyQuery(state,key_query){
            state.key_query = key_query
        },
        setDetail(state,data)
        {
            state.job_detail = data
        }
    },
    getters:{
        getKeyQueryEventSearch(state){
            return state.key_query.eventSearch
        },
        getKeyQuery(state){
            return state.key_query
        },
        getJobDetail(state)
        {
            return state.job_detail
        },
        getEnterprise(state)
        {
            return state.job_detail.enterprise
        },
        getSemilar(state)
        {
            return state.job_detail.similar
        }

    }
})