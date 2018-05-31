<template>
    <div class="tab-pane fade in active" id="profile">

        <!-- Profile info -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin cá nhân sinh viên <b>#1</b> </h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <form action="#">
                    <div class="row">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Họ:</label>
                                        <input type="text" v-model="infoStudent.first_name_student" placeholder="Họ" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên:</label>
                                        <input type="text" placeholder="Tên" v-model="infoStudent.last_name_student" required class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Avatar:</label>
                                        <input type="file" class="file-styled" @change="setFileAvatar($e)" accept="image/*">
                                        <span class="help-block">Chấp nhận file: gif, png, jpg. Kích cỡ tối đa 2Mb</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mức lương</label>
                                        <input type="text" placeholder="Nhập mức lương" required v-model="infoStudent.salary" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" placeholder="Địa chỉ" required v-model="infoStudent.address_student" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="text" placeholder="Email" required v-model="infoStudent.email_address_student" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Số điện thoại #:</label>
                                        <input type="text" v-model="infoStudent.phone_number_student" required placeholder="+99-99-9999-9999" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khoa:</label>
                                        <choose-info-select2 :required="true" :options="departments" v-model="infoStudent.id_department" data-placeholder="Chọn Khoa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chuyên ngành:</label>
                                        <choose-info-select2 :required="true" :options="branches" v-model="infoStudent.id_branch" data-placeholder="Chọn Ngành"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khóa:</label>
                                        <choose-info-select2 :required="true" :options="courses" v-model="infoStudent.id_course" data-placeholder="Chọn Khóa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group">
                                <label>Giới thiệu về sinh viên</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Thông tin thêm về sinh viên"></textarea>
                            </div>
                        </fieldset>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Lưu thông tin <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /profile info -->


        <!-- Account settings -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin tài khoản</h6>
                <div class="heading-elements">
                    <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                    </ul>
                </div>
            </div>

            <div class="panel-body">
                <form action="#">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mã sinh viên</label>
                                <input type="text" value="Kopyov" readonly="readonly" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Mật khẩu cũ</label>
                                <input type="password" value="password" readonly="readonly" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Mật khẩu mới</label>
                                <input type="password" placeholder="Enter new password" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" placeholder="Repeat new password" class="form-control">
                            </div>
                        </div>
                    </div>



                    <div class="text-right">
                        <button type="button" class="btn btn-info">Đặt lại mật khẩu <i class="icon-reset"></i></button>
                        <button type="submit" class="btn btn-primary">Lưu thông tin tài khoản <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /account settings -->

    </div>
</template>
<script>
    import chooseInfoSelect2 from './choose-info-select2.vue'
    export default {
        components: {
            'choose-info-select2': chooseInfoSelect2
        },
        mounted(){
            $('select').select2()
            $(".file-styled").uniform({
                fileButtonClass: 'action btn bg-pink-400'
            });
        },
        data(){
            return {
                infoStudent:{
                    id_department: '',
                    id_course: '',
                    id_branch: '',
                    first_name_student:'',
                    last_name_student:'',
                    address_student:'',
                    phone_number_student: '',
                    email_address_student: '',
                    introduce_student:'',
                    id_user:'',
                    avatar_student:'',
                    salary:''
                },
                departments:[
                    {
                        id:1,
                        text: 'Toán tin'
                    },
                    {
                        id:2,
                        text: 'Ngoại ngữ'
                    },
                    {
                        id:3,
                        text: 'Nhật'
                    },
                    {
                        id:4,
                        text: 'Trung'
                    },
                    {
                        id:5,
                        text: 'Thanh Nhạc'
                    }
                ],
                branches: [
                    {
                        id:1,
                        text: 'Khoa học máy tính'
                    },
                    {
                        id:2,
                        text: 'Ngoại ngữ'
                    },
                    {
                        id:3,
                        text: 'Nhật'
                    },
                    {
                        id:4,
                        text: 'Trung'
                    },
                    {
                        id:5,
                        text: 'Thanh Nhạc'
                    }
                ],
                courses : [
                    {
                        id:1,
                        text: 'K27'
                    },
                    {
                        id:2,
                        text: 'K28'
                    },
                    {
                        id:3,
                        text: 'K29'
                    },
                    {
                        id:4,
                        text: 'K30'
                    },
                    {
                        id:5,
                        text: 'K31'
                    }
                ]
            }
        },
        methods:{
            test_choose_value(value){
                console.log(value)
            },
            setFileAvatar(e){
                this.infoStudent.avatar_student = e.target.files[0]
            }
        }
    }
</script>