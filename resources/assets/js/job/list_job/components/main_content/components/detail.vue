<template>
    <!-- Details -->
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="media stack-media-on-mobile text-left content-group-lg">
                <a href="#" class="media-left media-middle">
                    <img :src="AvatarEnterPrise" class="img-rounded img-lg" alt="">
                </a>
                <div class="media-body">
                    <h5 class="media-heading text-semibold">{{infoDetail.title_post}}</h5>
                    <ul class="list-inline list-inline-separate text-muted no-margin">
                        <li><a href="javascript:void(0)">{{infoEnterprise.name_enterprise}}</a></li>
                        <li>{{infoEnterprise.address_enterprise}}</li>
                        <li>3 days ago</li>
                    </ul>
                </div>

                <div class="media-right media-middle text-nowrap">
                    <a href="#" class="btn bg-blue"><i class="icon-envelop2 position-left"></i> Gửi đơn ngay</a>
                </div>
            </div>

            <div class="content-group-lg">
                <h6 class="text-semibold">Các nơi làm việc</h6>
                <ul class="ul-skill" >
                    <li v-for="location in infoLocations" :key="location.city">
                        <span class="label label-success">{{location.city}}, {{location.location}}</span>
                    </li>

                </ul>
            </div>
            <div class="content-group-lg">
                <h6 class="text-semibold">Các kỹ năng yêu cầu</h6>
                <ul class="ul-skill" >
                    <li v-for="skill in infoSkill" :key="skill.name_skill">
                        <span class="label label-primary">{{skill.name_skill}}</span>
                    </li>

                </ul>
            </div>

            <div class="content-group-lg">
                <h6 class="text-semibold">Các vị trí tuyển dụng:</h6>

                <ul class="ul-skill" >
                    <li v-for="position in infoPosition" :key="position.name_position">
                        <span class="label label-info">{{position.name_position}}</span>
                    </li>

                </ul>
            </div>

            <div class="content-group-lg">
                <h6 class="text-semibold">Hình thức công việc</h6>
                <ul class="ul-skill" >
                    <li v-for="type in infoTypes" :key="type.name_job_type">
                        <span class="label label-info">{{type.name_job_type}}</span>
                    </li>

                </ul>
            </div>

            <div class="content-group-lg">
                <h6 class="text-semibold">Chi tiết tin tuyển dụng</h6>
                {{infoDetail.content_post}}
            </div>

            <div class="content-group-lg">
                <h6 class="text-semibold">Hạn gửi hồ sơ</h6>
                <p>Thời gian bắt đầu từ: <b>{{infoDetail.time_start_post}}</b> đến <b>{{infoDetail.time_end_post}}</b> </p>

            </div>

            <ul class="list-inline no-margin">
                <li class="mt-5">
                    <a href="#" class="btn bg-blue">
                        <i class="icon-envelop2 position-left"></i>
                        Gửi đơn ngay
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /details -->
</template>
<script>
    import store from './../../../Store'
    export default {
        store,
        computed: {
            infoDetail(){
                return this.$store.getters.getJobDetail.info
            },
            infoEnterprise(){
                return this.$store.getters.getEnterprise
            },
            AvatarEnterPrise(){
                return window.location.origin+this.infoEnterprise.avatar_enterprise+'?'+new Date()
            },
            infoSkill(){
                return this.$store.getters.getJobDetail.skills
            },
            infoPosition(){
                return this.$store.getters.getJobDetail.positions
            },
            infoTypes(){
                return this.$store.getters.getJobDetail.types
            },
            infoLocations(){
                return this.$store.getters.getJobDetail.locations
            }
        },
        methods:{

        }
    }
</script>
<style>
    .ul-skill{
        list-style-type: none;
        padding-bottom: 5px;
    }
    .ul-skill li{
        float: left;
        margin-left: 15px;

    }
</style>