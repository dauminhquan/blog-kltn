<template>
    <!-- Main content -->
    <div class="content-wrapper" id="content-wrapper">
        <datatable></datatable>
    </div>
    <!-- /main content -->
</template>
<script>
    import datatable from './components/datatable.vue'

    export default {
        components: {
            'datatable' : datatable
        },
        data(){
            return {

            }
        }
    }
</script>