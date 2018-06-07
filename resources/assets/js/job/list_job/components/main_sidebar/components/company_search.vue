<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-briefcase3 position-left"></i>
               Doanh nghiệp
            </div>

            <div class="heading-elements not-collapsible">
                <a href="#" class="heading-text">+ Add</a>
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="checkbox no-margin-top" v-for="(enterprise,index) in enterprises" :key="enterprise.id" v-if="index < max_show">
                        <label>
                            <input type="checkbox" class="styled" v-model="enterprises_selected" :value="enterprise.id">
                            {{enterprise.name_enterprise}}
                        </label>
                    </div>

                </div>
            </div>

            <div class="panel-footer no-padding">
                <a href="javascript:void(0)" class="btn btn-default btn-block no-border" @click="max_show = enterprises.length" v-if="max_show < enterprises.length">Xem tất cả doanh nghiệp</a>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        computed:{
            get_enterprises_selected(){
                return this.enterprises_selected
            }
        },
        props: [],
        data(){
            return {

                enterprises : [],
                enterprises_selected: [],
                max_show: 10
            }
        },
        methods:{
            getCompanies()
            {
                var vm = this
                axios.get('/api/job/get-list-enterprise').then(data => {
                    vm.enterprises = data.data
                }).catch(err => {
                    console.dir(err)
                })
            }
        },


        beforeUpdate(){

        },
        updated(){
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });
        },

        mounted(){
            this.getCompanies()

        }
        ,
        watch:{
            get_enterprises_selected: {
                handler(newValue){
                    this.$emit('change_enterprises_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>