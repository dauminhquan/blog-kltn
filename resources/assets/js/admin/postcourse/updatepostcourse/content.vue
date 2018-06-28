<template>
    <div class="content-wrapper">


        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">Thêm khóa học</h5>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">

                <form v-on:submit.prevent="updatePostCourse">


                    <fieldset class="content-group">
                        <legend class="text-bold">Chọn các mục</legend>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập tiêu đề</label>
                                    <input type="text" required v-model="title_post_course" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label">Nhập mô tả bài viết</label>
                                    <input type="text" required v-model="description_post_course" class="form-control">
                                </div>

                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label">Nhập địa điểm</label>
                                    <input type="text" v-model="location" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian bắt đầu nhận đăng ký</label>
                                    <input type="date" v-model="time_start" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label">Thời gian kết thúc đăng ký</label>
                                    <input type="date" v-model="time_end" required class="form-control">
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="control-label">Chọn file đính kèm</label>
                                    <input type="file" @change="setFile"  class="form-control">
                                </div>

                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="content-group">
                        <legend class="text-bold">Nội dung tin</legend>
                        <div class="form-group">
                            <textarea id="content-post-course" required class="form-control" v-model="content_post_course"></textarea>
                        </div>
                    </fieldset>

                    <div class="text-right">
                        <div class="pace-demo" v-if="uploading == true">
                            <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                        </div>
                        <button type="button" v-if="accepted == 0 && updateAccept == false" @click="acceptPostCourse" class="btn btn-success">Chấp nhận bài viết <i class="icon-check2 position-right"></i></button>
                        <button type="button" @click="deletePostCourse" class="btn btn-danger">Xóa bài viết <i class="icon-trash-alt position-right"></i></button>
                        <button type="submit" class="btn btn-primary">Lưu chỉnh sửa <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div id="modal_danger" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h6 class="modal-title"><i class="icon-warning"></i> Cảnh báo</h6>
                    </div>

                    <div class="modal-body">

                        <p> <i class="icon-warning"></i> Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
                        <div style="border: snow" class="panel panel-body border-top-danger text-center">
                            <div class="pace-demo" v-if="deleting == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" @click="acceptdeletePostCourse">Xác định xóa</button>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<script>

    import select2 from './components/select2.vue'
    import axios from './../../../axios'
    import configUrl from './../../../config'
    export default {
        components: {
            'select2': select2
        },
        props: ['id-post-course'],
        mounted(){
            this.getPostCourse()


            this.ckeditor = CKEDITOR.replace( 'content-post-course' );
            var vm = this
            this.ckeditor.on('change',function () {
                vm.content_post_course = this.getData()
            })
        },
        data(){
            return {
                configUrl: new configUrl(),
                uploading: false,
                deleting: false,
                accepted: -1,
                updateAccept: false,


                title_post_course:'',
                description_post_course: '',
                time_start: '',
                time_end: '',
                location: '',
                city: '',

                content_post_course: '',
                ckeditor: null,
                file: ''
            }
        },
        methods:{
            acceptPostCourse(){
                let vm = this
                axios.put(vm.configUrl.API_ADMIN_POST_COURSE_MANAGE_ACCEPT_POST_COURSE(vm.idPostCourse)).then(data => {
                    vm.accepted = 1
                    vm.updateAccept = true
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Chấp nhận thành công',
                        addclass: 'bg-success'
                    });
                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            deletePostCourse(){
                $('#modal_danger').modal('show')
            },
            acceptdeletePostCourse(){
                var vm = this
                vm.deleting = true
                axios.delete(vm.configUrl.API_ENTERPRISE_POST_COURSE+'/'+vm.idPostCourse).then(data => {

                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công bài viết',
                        addclass: 'bg-success'
                    });
                    setTimeout(function () {
                        window.location = vm.configUrl.WEB_ADMIN_POST_COURSES
                    },1000)
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ server',
                        addclass: 'bg-danger'
                    });
                })
            },
            updatePostCourse(){
                var vm = this
                vm.uploading = true
                var formData = new FormData()

                formData.append('content_post_course',vm.content_post_course)

                formData.append('location',vm.location)
                formData.append('time_end',vm.time_end)
                formData.append('time_start',vm.time_start)
                formData.append('title_post_course',vm.title_post_course)
                formData.append('description_post_course',vm.description_post_course)
                formData.append('file_attach_post_course',vm.file)
                axios.post(vm.configUrl.API_ENTERPRISE_POST_COURSE+'/'+vm.idPostCourse,formData).then(data => {
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Update bài đăng thành công',
                        addclass: 'bg-success'
                    });
                    vm.uploading = false

                }).catch(err => {
                    console.dir(err)
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi xảy ra từ server!',
                        addclass: 'bg-danger'
                    });
                    vm.uploading = false
                })
            },
            getPostCourse(){
                let vm = this
                axios.get(vm.configUrl.API_ENTERPRISE_POST_COURSE+'/'+vm.idPostCourse).then(data => {

                    vm.description_post_course = data.data.description_post_course
                    vm.content_post_course = data.data.content_post_course
                    vm.location = data.data.location
                    vm.title_post_course = data.data.title_post_course
                    vm.time_start = data.data.time_start
                    vm.time_end = data.data.time_end
                    vm.accepted = data.data.accept
                }).catch(err => {

                })
            },
            setFile(e){

                this.file = e.target.files[0]
            }
        }
    }
</script>