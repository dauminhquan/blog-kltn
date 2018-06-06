<template>
    <div class="panel panel-white">
        <div class="panel-heading">
            <div class="panel-title text-semibold">
                <i class="icon-calendar3 position-left"></i>
                Ngày đăng
            </div>
        </div>
        <form action="#">
            <div class="panel-body">
                <div class="form-group">
                    <div class="radio no-margin-top">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Hôm nay
                            <span class="text-muted text-size-small">&nbsp;(632)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Hôm qua
                            <span class="text-muted text-size-small">&nbsp;(431)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Tuần trước
                            <span class="text-muted text-size-small">&nbsp;(31)</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Tháng trước
                            <span class="text-muted text-size-small">&nbsp;(124)</span>
                        </label>
                    </div>

                    <div class="radio no-margin-bottom">
                        <label>
                            <input type="radio" name="when_posted" class="styled">
                            Bất kỳ lúc nào
                        </label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        computed:{
            get_dates_selected(){
                return this.dates_selected
            }
        },
        props: [],
        data(){
            return {

                dates : [],
                dates_selected: []
            }
        },
        methods:{
            // getTypesJob()
            // {
            //     // var vm = this
            //     // axios.get('/api/job/get-list-dat').then(data => {
            //     //     vm.dates = data.data
            //     // }).catch(err => {
            //     //     console.dir(err)
            //     // })
            // }
        },


        beforeUpdate(){

        },
        updated(){
            $(".styled, .multiselect-container input").uniform({
                radioClass: 'choice'
            });
        },

        mounted(){
            // this.getTypesJob()

        }
        ,
        watch:{
            get_dates_selected: {
                handler(newValue){
                    this.$emit('change_dates_selected',newValue)
                },
                deep: true
            }
        }
    }
</script>