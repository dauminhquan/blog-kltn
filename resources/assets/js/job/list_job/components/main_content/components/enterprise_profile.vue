<template>
    <!-- Company profile -->
    <div>
        <h5 class="pt-10 content-group">Thông tin doanh nghiệp</h5>
        <div class="panel panel-flat">
            <div class="panel-body">
                <div class="media stack-media-on-mobile text-left content-group">
                    <a href="#" class="media-left media-middle">
                        <img src="assets/images/placeholder.jpg" class="img-rounded img-lg" alt="">
                    </a>

                    <div class="media-body">
                        <h5 class="media-heading text-semibold">{{infoEnterprise.name_enterprise}}</h5>
                        <ul class="list-inline list-inline-separate text-muted no-margin">
                            <li>IT Services</li>
                        </ul>
                    </div>

                    <div class="media-right media-middle text-nowrap">
                        <ul class="list-inline no-margin">
                            <li><a href="#" class="btn bg-blue"><i class="icon-menu7 position-left"></i> Thông tin chi tiết</a></li>
                        </ul>
                    </div>
                </div>

                <p>{{infoEnterprise.introduce_enterprise}}</p>
            </div>
        </div>
    </div>
    <!-- /company profile -->
</template>
<script>
    import store from './../../../Store'
    export default {
        store,
        computed:{
            infoEnterprise(){
                return this.$store.getters.getEnterprise
            },
        }
    }
</script>