<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-stars position-left"></i>
                Kỹ năng
            </div>

            <div class="heading-elements not-collapsible">
                <a href="#" class="heading-text">+ Add</a>
            </div>
        </div>

        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="checkbox no-margin-top" v-for="(skill,index) in skills" :key="skill.id" v-if="index < max_show">
                        <label>
                            <input type="checkbox" class="styled" v-model="skills_selected" :value="skill.id">
                            {{skill.name_skill}}
                        </label>
                    </div>
                </div>
            </div>

            <div class="panel-footer no-padding">
                <a href="javascript:void(0)" class="btn btn-default btn-block no-border" @click="max_show = skills.length" v-if="max_show < skills.length">Xem tất cả kỹ năng</a>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        computed:{
            get_skills_selected(){
                return this.skills_selected
            }
        },
        props: [],
        data(){
            return {

                skills : [],
                skills_selected: [],
                max_show: 10
            }
        },
        methods:{
            getSkills()
            {
                var vm = this
                axios.get('/api/job/get-list-skill').then(data => {
                    vm.skills = data.data
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
            this.getSkills()

        }
        ,
        watch:{
            get_skills_selected: {
                handler(newValue){
                    this.$emit('change_skills_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>