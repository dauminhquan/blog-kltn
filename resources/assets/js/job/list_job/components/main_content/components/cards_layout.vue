<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <h6 class="panel-title text-semibold">Danh sách tin tuyển dụng</h6>
        </div>

        <ul class="media-list">
            <li v-for="post in posts"  class="media panel-body stack-media-on-mobile">
                <div class="media-left">
                    <a href="#">
                        <img :src="post.avatar_enterprise" class="img-rounded img-lg" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <h6 class="media-heading text-semibold">
                        <a href="#">{{post.title_post}}</a>
                    </h6>
                    <ul class="list-inline list-inline-separate text-muted mb-10">
                        <li><a href="#" class="text-muted">{{post.name_enterprise}}</a></li>
                        <li>{{post.city + ', '+post.location }}</li>
                    </ul>
                    {{post.description_post}}
                </div>

                <div class="media-right text-nowrap">
                    <span class="label bg-blue" v-if="CheckNew(post.updated_at) <= 24">New</span>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {

        computed: {

        },

        props: ['current_page'],




        data(){
            return {
                posts: [

                ],
            }
        },

        beforeMount(){

        }
        ,
        mounted(){

            this.getPosts()
        },


        methods:{
            getPosts(){
                var vm = this
                axios.get('/api/job/get-list-job?page='+vm.current_page).then(data => {
                    vm.posts = data.data.data
                    vm.$emit('set_total_page',parseInt(data.data.total/2)+1)
                }).catch(err => {
                    console.log(err)
                })
            },
            CheckNew(date)
            {
               return Math.abs(new Date() - new Date(date))/1000/60/60
            }
        },
        watch:{
            current_page(){
                this.getPosts()
            }
        }
    }
</script>