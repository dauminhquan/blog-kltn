<template>
    <div class="sidebar sidebar-main sidebar-default sidebar-separate">
        <div class="sidebar-content">

            <!-- User details -->
            <div class="content-group">
                <div class="panel-body bg-indigo-400 border-radius-top text-center" style="background-image: url(http://demo.interface.club/limitless/assets/images/bg.png); background-size: contain;">
                    <div class="content-group-sm">
                        <h6 class="text-semibold no-margin-bottom">
                            {{user_name}}
                        </h6>

                        <span class="display-block" >{{graduated}}</span>

                    </div>

                    <a href="#" class="display-inline-block content-group-sm">
                        <img :src="avatar_user" class="img-circle img-responsive" alt="" style="width: 110px; height: 110px;">
                    </a>

                    <ul class="list-inline list-inline-condensed no-margin-bottom">
                        <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-google-drive"></i></a></li>
                        <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-twitter"></i></a></li>
                        <li><a href="#" class="btn bg-indigo btn-rounded btn-icon"><i class="icon-github"></i></a></li>
                    </ul>
                </div>

                <div class="panel no-border-top no-border-radius-top">
                    <ul class="navigation">
                        <li class="navigation-header">Navigation</li>
                        <li class="active"><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i> Thông tin cá nhân</a></li>


                        <li><a href="#work" data-toggle="tab"><i class="icon-files-empty"></i> Thông tin công việc</a></li>

                    </ul>
                </div>
            </div>
            <!-- /user details -->


            <!-- Online users -->
            <div class="sidebar-category">
                <div class="category-title">
                    <span>Các việc làm gần nhất</span>
                    <ul class="icons-list">
                        <li><a href="#" data-action="collapse"></a></li>
                    </ul>
                </div>

                <div class="category-content">
                    <ul class="media-list">
                        <li class="media">
                            <a href="#" class="media-left"><img :src="avatar_user" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">James Alexander</a>
                                <span class="text-size-mini text-muted display-block">Santa Ana, CA.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-success"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Jeremy Victorino</a>
                                <span class="text-size-mini text-muted display-block">Dowagiac, MI.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-danger"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Margo Baker</a>
                                <span class="text-size-mini text-muted display-block">Kasaan, AK.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-success"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Beatrix Diaz</a>
                                <span class="text-size-mini text-muted display-block">Neenah, WI.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-warning"></span>
                            </div>
                        </li>

                        <li class="media">
                            <a href="#" class="media-left"><img src="http://localhost:8000/assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                            <div class="media-body">
                                <a href="#" class="media-heading text-semibold">Richard Vango</a>
                                <span class="text-size-mini text-muted display-block">Grapevine, TX.</span>
                            </div>
                            <div class="media-right media-middle">
                                <span class="status-mark border-grey-400"></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- /online-users -->
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        props : ['code_student'],
        mounted(){
            console.log(this.code_student)
            this.getAvatarUser()
        },
        data(){
            return {
                avatar_user : '',
                user_name: '',
                graduated:''
            }
        },
        methods:{
            getAvatarUser(){
                var vm = this
                axios.get('/api/request-info/get-option-student?code_student='+vm.code_student+'&option[]=avatar_student&option[]=first_name_student&option[]=last_name_student&option[]=graduated').then(data => {
                    console.log(data)
                    vm.avatar_user = data.data.avatar_student
                    vm.user_name = data.data.first_name_student + ' ' +data.data.last_name_student
                    if(data.data.graduated == 1)
                    {
                        vm.graduated = 'Đã tốt nghiệp'
                    }
                    else{
                        vm.graduated = 'Chưa tốt nghiệp'
                    }

                }).catch(err => {

                })
            }
        }
    }
</script>