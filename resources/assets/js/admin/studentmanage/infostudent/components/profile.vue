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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Họ:</label>
                                        <input type="text" v-model="infoStudent.first_name_student" placeholder="Họ" required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tên:</label>
                                        <input type="text" placeholder="Tên" v-model="infoStudent.last_name_student" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
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
                                        <input type="email" placeholder="Email" required v-model="infoStudent.email_address_student" @blur="checkExistEmail" :class="classEmail">
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
                                        <choose-info-select2 :required="true" :options="departments" v-model="code_department" data-placeholder="Chọn Khoa"  class="select">

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
                                        <label>Mã sinh viên</label>
                                        <input type="text" v-bind:value="infoStudent.code_student" required placeholder="Nhập mã sinh viên" readonly :class="classCodeStudent">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.password"  placeholder="Nhập mật khẩu" :class="classPassword">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nhập lại mật khẩu:</label>
                                        <input type="password" v-model="infoStudent.rep_password"  placeholder="Nhập lại mật khẩu" :class="classOldPassword">
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
            },
            getCodeBranch(){
                return this.infoStudent.code_branch
            }
        },
        components: {
            'choose-info-select2': chooseInfoSelect2
        },
        beforeUpdate()
        {

        }
        ,
        updated(){

        }
        ,
        beforeMount(){

        },
        mounted(){
            this.getCourses();
            this.getDepartments();
            this.getInforStudent()
            $(".file-styled").uniform({
                fileButtonClass: 'action btn bg-pink-400'
            });
            // lấy danh sách khóa học

        },
        created(){
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
                    avatar_student: '',
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

                        vm.code_department = data.data.code_department
                        vm.infoStudent.address_student = data.data.info_student.address_student
                        vm.infoStudent.avatar_student = data.data.info_student.avatar_student
                        vm.infoStudent.code_course = data.data.info_student.code_course
                        vm.infoStudent.code_branch = data.data.info_student.code_branch
                        vm.infoStudent.email_address_student = data.data.info_student.email_address_student
                        vm.infoStudent.first_name_student = data.data.info_student.first_name_student
                        vm.infoStudent.graduated = data.data.info_student.graduated
                        vm.infoStudent.introduce_student = data.data.info_student.introduce_student
                        vm.infoStudent.last_name_student = data.data.info_student.last_name_student
                        vm.infoStudent.phone_number_student = data.data.info_student.phone_number_student
                        vm.infoStudent.salary = data.data.info_student.salary
                        vm.infoStudent.code_student = vm.code_student
                        console.log(vm.infoStudent)
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
                var vm =this
                if(vm.exist_email == false && vm.infoStudent.code_branch != null && vm.exist_code_student == false && vm.infoStudent.password == vm.infoStudent.rep_password)
                {

                    axios.put('/api/admin/student-manage/update-student',vm.infoStudent).then(data => {
                        console.log(data)
                        new PNotify({
                            title: 'Ohh Yeah! Thành công!',
                            text: 'Update thông tin sinh viện thành công',
                            addclass: 'bg-success'
                        });
                        // setTimeout(function () {
                        //     window.location
                        // },2000)
                    }).catch(err => {
                        console.log(err)
                        new PNotify({
                            title: 'Ohh! Có lỗi xảy ra rồi!',
                            text: 'Đã có lỗi xảy ra từ server!',
                            addclass: 'bg-danger'
                        });
                    })
                }
            },
            checkExistEmail()
            {
                var vm = this
                axios.post('/api/request-info/check-exist-info-student',{
                    email_address_student : vm.infoStudent.email_address_student,
                    code_student : vm.code_student
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
                handler(newValue,oldValue){
                    console.log(oldValue)
                    if(oldValue != '')
                    {
                        this.infoStudent.code_branch = null
                    }
                    this.getBranches(newValue)
                },
                deep: true
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
            },
            getCodeBranch:{
                handler(newValue,oldValue)
                {
                    if(newValue == '')
                    {
                        this.infoStudent.code_branch = oldValue
                    }
                },
                deep: true
            }
        },
        props: ['code_student']
    }
</script>