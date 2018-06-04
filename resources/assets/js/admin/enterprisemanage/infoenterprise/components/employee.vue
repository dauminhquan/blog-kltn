<template>
    <div class="tab-pane fade" id="work">

        <!-- Orders history -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin về công việc</h6>

            </div>



            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th colspan="2">Doanh nghiệp</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Chức vụ</th>

                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="work in work_student" :key="work.user_enterprise">
                        <td class="no-padding-right avatar-user" style="width: 45px;">
                            <a href="#">
                                <img :src="getAvatar(work.avatar_enterprise)" height="60" class="" alt="">
                            </a>
                        </td>
                        <td>
                            <a href="#" class="text-semibold">{{work.name_enterprise}}</a>
                            <div class="text-muted text-size-small" style="width: 200px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap">
                                <span class="status-mark bg-grey position-left"></span>
                                {{work.introduce_enterprise}}
                            </div>
                        </td>
                        <td>{{work.time_start.date}}</td>
                        <td>{{work.time_end}}</td>
                        <td>
                            <a href="javascript:void(0)">{{work.position}}</a>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <!-- /orders history -->

    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        props: ['code_student'],
        data() {
            return {
                work_student: []
            }
        },
        methods: {
            getWorkStudent()
            {
                var vm = this
                axios.get('/api/admin/student-manage/get-work-student?code_student='+vm.code_student).then(data => {
                    console.log(data)
                    vm.work_student = data.data
                }).catch(err => {
                    console.log(err)
                })
            },
            getAvatar(url){
                return window.location.origin+url
            }
        },
        mounted(){
            this.getWorkStudent()
        }
    }
</script>
<style>
    .avatar-user{

    }
    .avatar-user img{
        border-radius: 50%;
        width: 60px;
    }

</style>