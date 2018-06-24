<template>
    <fieldset class="content-group">
        <legend class="text-bold">Chọn các mục</legend>

        <div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Nhập tiêu đề</label>
                    <input type="text" required v-model="title_post" class="form-control">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Mô tả ngắn gọn</label>
                    <input type="text" v-model="description_post" required class="form-control">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Chọn các vị trí tuyển dụng</label>
                    <select2 :options="positions" v-model="list_positions" required="true" :data-placeholder="'Chọn các vị trí'" multiple="true"></select2>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Chọn các kỹ năng</label>
                    <select2 :options="skills" v-model="list_skills"  required="true" multiple="true"></select2>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Chọn các hình thức tuyển dụng</label>
                    <select2 :options="types" v-model="list_types" required="true" multiple="true"></select2>
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Chọn thành phố</label>
                    <select2 :options="locals" v-model="city" required="true" multiple="true"></select2>
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
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Thời gian bắt đầu nhận hồ sơ</label>
                    <input type="date" v-model="time_start_post" required class="form-control">
                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="control-label">Thời gian kết thúc nhận hồ sơ</label>
                    <input type="date" v-model="time_end_post" required class="form-control">
                </div>

            </div>
        </div>
    </fieldset>
</template>
<script>
    import select2 from './select2.vue'
    import axios from 'axios'
    export default {
        components: {
            'select2': select2
        },
        mounted(){
            this.getSkills()
            this.getPositions()
            this.getTypes()
        },
        methods:{
            getSkills()
            {
                var vm = this
                axios.get('/api/job/get-list-skill').then(data => {
                    vm.skills = data.data
                    if(vm.skills.length > 0)
                    {
                        vm.skills = vm.skills.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_skill
                            }
                        })
                    }
                }).catch(err => {
                    console.dir(err)
                })
            },
            getPositions()
            {
                var vm = this
                axios.get('/api/job/get-list-position').then(data => {
                    vm.positions = data.data
                    if(vm.positions.length > 0)
                    {
                        vm.positions = vm.positions.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_position
                            }
                        })
                    }
                }).catch(err => {
                    console.dir(err)
                })
            },
            getTypes(){
                var vm = this
                axios.get('/api/job/get-list-type-job').then(data => {
                    vm.types = data.data
                    if(vm.types.length > 0)
                    {
                        vm.types = vm.types.map(item =>{
                            return {
                                id: item.id,
                                text: item.name_job_type
                            }
                        })
                    }
                }).catch(err => {
                    console.dir(err)
                })
            },
        },
        data(){
            return {
                locals : [
                    "An Giang"
                    ,"Bà Rịa - Vũng Tàu"
                    ,"Bắc Giang"
                    ,"Bắc Kạn"
                    ,"Bạc Liêu"
                    ,"Bắc Ninh"
                    ,"Bến Tre"
                    ,"Bình Định"
                    ,"Bình Dương"
                    ,"Bình Phước"
                    ,"Bình Thuận"
                    ,"Cà Mau"
                    ,"Cao Bằng"
                    ,"Đắk Lắk"
                    ,"Đắk Nông"
                    ,"Điện Biên"
                    ,"Đồng Nai"
                    ,"Đồng Tháp"
                    ,"Gia Lai"
                    ,"Hà Giang"
                    ,"Hà Nam"
                    ,"Hà Tĩnh"
                    ,"Hải Dương"
                    ,"Hậu Giang"
                    ,"Hòa Bình"
                    ,"Hưng Yên"
                    ,"Khánh Hòa"
                    ,"Kiên Giang"
                    ,"Kon Tum"
                    ,"Lai Châu"
                    ,"Lâm Đồng"
                    ,"Lạng Sơn"
                    ,"Lào Cai"
                    ,"Long An"
                    ,"Nam Định"
                    ,"Nghệ An"
                    ,"Ninh Bình"
                    ,"Ninh Thuận"
                    ,"Phú Thọ"
                    ,"Quảng Bình"
                    ,"Quảng Nam"
                    ,"Quảng Ngãi"
                    ,"Quảng Ninh"
                    ,"Quảng Trị"
                    ,"Sóc Trăng"
                    ,"Sơn La"
                    ,"Tây Ninh"
                    ,"Thái Bình"
                    ,"Thái Nguyên"
                    ,"Thanh Hóa"
                    ,"Thừa Thiên Huế"
                    ,"Tiền Giang"
                    ,"Trà Vinh"
                    ,"Tuyên Quang"
                    ,"Vĩnh Long"
                    ,"Vĩnh Phúc"
                    ,"Yên Bái"
                    ,"Phú Yên"
                    ,"Cần Thơ"
                    ,"Đà Nẵng"
                    ,"Hải Phòng"
                    ,"Hà Nội"
                    ,"TP HCM"
                ],
                types: [],
                positions: [],
                skills: [],
                title_post:'',
                list_types: [],
                list_skills: [],
                list_positions: [],
                time_start_post: '',
                time_end_post: '',
                location: '',
                city: '',
                description_post: ''
            }
        }
    }
</script>