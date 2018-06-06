<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-menu7 position-left"></i>
                Vị trí công việc
            </div>

            <div class="heading-elements not-collapsible">
                <a href="#" class="heading-text">+ Add</a>
            </div>
        </div>

        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="checkbox no-margin-top" v-for="(position,index) in positions" :key="position.id" v-if="index < max_show">
                        <label>
                            <input type="checkbox" class="styled" v-model="positions_selected" :value="position.id">
                            {{position.name_position}}
                        </label>
                    </div>
                </div>
            </div>

            <div class="panel-footer no-padding">
                <a href="javascript:void(0)" class="btn btn-default btn-block no-border" @click="max_show = positions.length" v-if="max_show < positions.length">Xem tất cả vị trí</a>
            </div>
        </form>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        computed:{
            get_positions_selected(){
                return this.positions_selected
            }
        },
        props: [],
        data(){
            return {

                positions : [],
                positions_selected: [],
                max_show:10
            }
        },
        methods:{
            getPositions()
            {
                var vm = this
                axios.get('/api/job/get-list-position').then(data => {
                    vm.positions = data.data
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
            this.getPositions()

        }
        ,
        watch:{
            get_positions_selected: {
                handler(newValue){
                    this.$emit('change_positions_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>