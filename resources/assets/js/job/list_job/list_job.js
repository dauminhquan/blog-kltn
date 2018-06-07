window.Vue = require('vue');
import main_sidebar from './components/main_sidebar/main_sidebar.vue'
import main_content from './components/main_content/main_content.vue'
import detail_content from './components/main_content/detail_content.vue'
import store from './Store'
const app = new Vue({
    store,
    el: '#page-content',
    components: {
        'main-sidebar' : main_sidebar,
        'main-content' : main_content,
        'detail-content' : detail_content
    },
    mounted(){

    },
    updated(){
    },
    computed:{
      JobDetail(){
          return this.$store.getters.getJobDetail
      },
        JobDetailEmpty(){
          return this.isEmpty(this.JobDetail)
        }
    },
    methods: {
        search(){

        },
        isEmpty(obj) {
            for(var prop in obj) {
                if(obj.hasOwnProperty(prop))
                    return false;
            }

            return true
        }
    },
})
