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
                <!-- 2 columns form -->
                <form v-on:submit.prevent="submitUpdateStudent">



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
                                        <input type="email" placeholder="Email" required v-model="infoStudent.email_address_student" :class="classEmail">
                                        <span class="help-block text-danger" v-if="exist_email == true"><i class="icon-warning22"></i> Email đã tồn tại</span>
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
                                        <choose-info-select2 :required="true" :options="departments" :value="code_department" v-model="code_department" data-placeholder="Chọn Khoa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Chuyên ngành:</label>
                                        <choose-info-select2 :required="true" :readonly="true" :un-readonly="code_department" :options="branches" v-model="infoStudent.code_branch" data-placeholder="Chọn Ngành"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Khóa:</label>
                                        <choose-info-select2 :required="true" :options="courses" v-model="infoStudent.code_course" data-placeholder="Chọn Khóa"  class="select">

                                        </choose-info-select2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Điền mã sinh viên:</label>
                                        <input type="text" v-model="infoStudent.code_student" required placeholder="Nhập mã sinh viên" :class="classCodeStudent">
                                        <span class="help-block text-danger" v-if="exist_code_student == true"><i class="icon-warning22"></i> Tài khoản đã tồn tại</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.password" required placeholder="Nhập mật khẩu" :class="classPassword">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.rep_password" required placeholder="Nhập lại mật khẩu" :class="classOldPassword">
                                    </div>
                                </div>


                            </div>
                            <div class="form-group">
                                <label>Điền thông tin thêm về sinh viên</label>
                                <textarea rows="5" cols="5" class="form-control" placeholder="Điền thông tin thêm về sinh viên"></textarea>
                            </div>
                        </fieldset>
                    </div>
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
                <!-- /2 columns form -->
            </div>
        </div>
        <!-- /profile info -->



    </div>
</template>
<script>
    import chooseInfoSelect2 from './choose-info-select2.vue'
    import axios from 'axios'
    export default {
        computed: {
            getInforEmail(){
                return this.infoStudent.email_address_student
            },
            getInforCodeStudent(){
                return this.infoStudent.code_student
            },
            getPassword(){
                return this.infoStudent.password
            },
            getRepPassword(){
                return this.infoStudent.rep_password
            }
        },
        components: {
            'choose-info-select2': chooseInfoSelect2
        },
        beforeMount(){

        },
        mounted(){
            this.getInforStudent()
            $(".file-styled").uniform({
                fileButtonClass: 'action btn bg-pink-400'
            });
            // lấy danh sách khóa học
            this.getCourses();
            this.getDepartments();
        },
        data(){
            return {
                code_department: '',
                infoStudent:{
                    code_course: '',
                    code_branch: '',
                    first_name_student:'',
                    last_name_student:'',
                    address_student:'',
                    phone_number_student: '',
                    email_address_student: '',
                    introduce_student:'',
                    avatar_student:'',
                    salary:'',
                    code_student: '',
                    password: '',
                    rep_password: '',
                },
                departments:[
                ],
                branches: [

                ],
                courses : [

                ],

                exist_email: false,
                exist_code_student: false,
                classEmail : ['form-control'],
                classCodeStudent : ['form-control'],
                classPassword : ['form-control'],
                classOldPassword : ['form-control'],
            }
        },
        methods:{
            setFileAvatar(e){
                this.infoStudent.avatar_student = e.target.files[0]
            },
            getCourses()
            {
                var vm = this
                axios.get('/api/request-info/get-courses').then(data => {
                    var courses = data.data
                    vm.courses = [{id:'',text:''}]
                    courses.forEach(item => {
                        vm.courses.push({
                            id: item.code_course,
                            text: item.name_course
                        })
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getInforStudent(){
                var vm =this
                    axios.get('/api/request-info/get-info-student?code_student='+vm.code_student).then(data => {
                       console.log(data.data)
                        vm.code_department = 'TI'
                        vm.infoStudent = data.data
                    }).catch(err => {

                    })
            },
            getDepartments()
            {
                var vm = this
                axios.get('/api/request-info/get-departments').then(data => {
                    var courses = data.data
                    vm.departments = [{id:'',text:''}]
                    courses.forEach(item => {

                        vm.departments.push({
                            id: item.code_department,
                            text: item.name_department
                        })
                    })
                }).catch(err =>{
                    console.log(err)
                })
            },
            getBranches(code_department)
            {
                if(code_department != '')
                {
                    var vm = this
                    vm.branches = [{
                        id: '',
                        text: ''
                    }]
                    axios.get('/api/request-info/get-branches/'+code_department).then(data => {
                        var branches = data.data;

                        branches.forEach(item => {
                            vm.branches.push({
                                id: item.code_branch,
                                text: item.name_branch
                            })
                        })
                    }).catch(error => {

                    })
                }
            },
            submitUpdateStudent(){
                // var vm =this
                // if(vm.exist_email == false && vm.exist_code_student == false && vm.infoStudent.password == vm.infoStudent.rep_password)
                // {
                //     axios.post('/api/admin/student-manage/add-student',vm.infoStudent).then(data => {
                //         new PNotify({
                //             title: 'Ohh Yeah! Thành công!',
                //             text: 'Thêm mới sinh viên thành công',
                //             addclass: 'bg-success'
                //         });
                //         setTimeout(function () {
                //             window.location.href = window.location.origin+'/admin/student-manage'
                //         },2000)
                //     }).catch(err => {
                //         console.log(err)
                //         new PNotify({
                //             title: 'Ohh! Có lỗi xảy ra rồi!',
                //             text: 'Đã có lỗi xảy ra từ server!',
                //             addclass: 'bg-danger'
                //         });
                //     })
                // }
            },
            checkExistEmail(value)
            {
                var vm = this
                axios.post('/api/request-info/check-exist-info-student',{
                    email_address_student : value
                }).then(data => {

                    if(data.data[0].email_address_student == 1)
                    {
                        vm.exist_email = true
                        vm.classEmail.push('border-danger')
                    }
                    else{
                        vm.exist_email = false
                        var index = vm.classEmail.indexOf('border-danger')
                        if(index > -1)
                        {
                            vm.classEmail.splice(index,1)
                        }
                    }
                }).catch(error => {
                    console.log(error)
                })
            },
            checkExistCodeStudent(value)
            {
                var vm = this
                axios.post('/api/request-info/check-exist-info-student',{
                    code_student : value
                }).then(data => {

                    if(data.data[0].code_student == 1)
                    {
                        vm.exist_code_student = true
                        vm.classCodeStudent.push('border-danger')
                    }
                    else{
                        vm.exist_code_student = false
                        var index = vm.classCodeStudent.indexOf('border-danger')
                        if(index > -1)
                        {
                            vm.classCodeStudent.splice(index,1)
                        }
                    }
                }).catch(error => {
                    console.log(error)
                })
            },
            setDrangerClass(value)
            {
                value.push('border-danger')
                return value
            },
            upsetDrangerClass(value)
            {
                var index = value.indexOf('border-danger')
                if(index > -1)
                {
                    value.splice(index,1)
                }
                return value
            },
            checkHasDrangerClass(value)
            {
                var index = value.indexOf('border-danger')
                if(index > -1)
                {
                    return true
                }
                return false
            }
        },
        watch: {
            code_department: {
                handler(newValue){
                    // console.log(newValue)
                    this.getBranches(newValue)
                },
                deep: true
            },
            getInforEmail:{
                handler(newValue,oldValue)
                {
                    this.checkExistEmail(newValue)
                },
                deep : true
            },
            getInforCodeStudent:{
                handler(newValue,oldValue)
                {
                    this.checkExistCodeStudent(newValue)
                },
                deep : true
            },
            getPassword:{
                handler(newValue)
                {
                    this.classPassword = this.upsetDrangerClass(this.classPassword)
                    if(newValue != this.infoStudent.rep_password)
                    {
                        if(!this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.setDrangerClass(this.classOldPassword)
                        }

                    }
                    else{
                        if(this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.upsetDrangerClass(this.classOldPassword)
                        }
                    }
                },
                deep: true
            },
            getRepPassword:{
                handler(newValue)
                {
                    if(newValue != this.infoStudent.password)
                    {
                        if(!this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.setDrangerClass(this.classOldPassword)
                        }
                    }
                    else{
                        if(this.checkHasDrangerClass(this.classOldPassword))
                        {
                            this.classOldPassword = this.upsetDrangerClass(this.classOldPassword)
                        }
                    }
                },
                deep: true
            }
        },
        props: ['code_student']
    }
</script>