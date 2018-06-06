import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        key_query: {},
    },
    mutations:{
        updateKeyQuery(state,key_query){
            state.key_query = key_query
        },
    },
    getters:{
        getKeyQueryEventSearch(state){
            return state.key_query.eventSearch
        },
        getKeyQuery(state){
            return state.key_query
        },
    }
})