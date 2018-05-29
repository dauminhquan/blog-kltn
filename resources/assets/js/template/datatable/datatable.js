window.Vue = require('vue');
import App from './contentWrapper.vue'
import store from './store'
Vue.component('content-wrapper',App)
const app = new Vue({
    store:store,
   el: '#page-content',
})

window.addSelect = function()
{
    app.$store.commit('setSelected',[1,2,3,4,5])
}
