<template>
    <div class="container-detached">
        <div class="content-detached">
            <detail></detail>
            <enterprise-profile></enterprise-profile>
            <similar-job></similar-job>
        </div>
    </div>
    <!-- /detached content -->
</template>
<script>
    import detail from './components/detail.vue'
    import enterprise_profile from './components/enterprise_profile.vue'
    import similar_job from  './components/similar_jobs.vue'
    export default {
        components :{
            'detail' : detail,
            'enterprise-profile' : enterprise_profile,
            'similar-job' : similar_job
        }
    }
</script>