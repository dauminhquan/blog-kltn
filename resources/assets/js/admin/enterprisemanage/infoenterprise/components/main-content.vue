<template>
    <div class="content-wrapper">

        <!-- Tab content -->
        <div class="tab-content">
            <profile :active="true" :email_address_enterprise="email_address_enterprise" ></profile>

            <employee :email_address_enterprise="email_address_enterprise"></employee>
            <list-post :email_address_enterprise="email_address_enterprise"></list-post>
        </div>
        <!-- /tab content -->
    </div>
</template>
<script>
    import profile from './profile.vue'
    import employee from './employee.vue'
    import list_post from './list_post'
    export default {
        components: {
            'list-post': list_post,
            'profile' : profile,
            'employee': employee
        },
        data(){
            return {

            }
        },
        mounted(){

        },
        props:["email_address_enterprise"]
    }
</script>