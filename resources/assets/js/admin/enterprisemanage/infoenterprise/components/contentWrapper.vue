<template>
    <div class="content-wrapper">



        <!-- 2 columns form -->
        <form action="#">
            <div class="panel panel-flat">


                <div class="panel-body">
                    <div class="row">
                        <fieldset>
                            <legend class="text-semibold"><i class="icon-reading position-left"></i>Điền thông tin sinh viên</legend>

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
                                        <label>Nhập mức lương</label>
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
                                <label>Điền thông tin thêm về sinh viên</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Điền thông tin thêm về sinh viên"></textarea>
                            </div>
                        </fieldset>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Thêm mới sinh viên <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /2 columns form -->

    </div>
</template>
<script>
    import choose_info_select2 from './choose-info-select2'
    export default {
        components: {
            'choose-info-select2': choose_info_select2
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