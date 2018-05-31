<template>
    <div class="content-wrapper">

        <!-- Tab content -->
        <div class="tab-content">
            <profile :active="true"></profile>

            <work></work>
        </div>
        <!-- /tab content -->
    </div>
</template>
<script>
    import profile from './profile.vue'
    import work from './work.vue'
    export default {
        components: {
            'profile' : profile,
            'work': work
        },
        mounted(){
            // Styled file input
            $(".file-styled").uniform({
                fileButtonClass: 'action btn bg-warning'
            });


            // Styled checkboxes, radios
            $(".styled").uniform({
                radioClass: 'choice'
            });
        }
    }
</script>