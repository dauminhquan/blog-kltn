

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td class="avatar-user"><img :src="getAvatar(item.avatar_enterprise)" alt=""></td>
        <td><a :href="infoEnterprise(item.email_address_enterprise)">{{item.name_enterprise}}</a></td>
        <td><a :href="infoPost(item.id)" target="_blank">{{item.title_post}}</a></td>
        <td>{{item.created_at}}</td>

        <td><span class="label label-default" v-if="item.accept == 0">Đang đợi duyệt</span> <span v-if="item.accept == 1" class="label label-success" >Đã đăng</span> <span v-else class="label label-danger" >Đã hủy</span> </td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa bài viết</a></li>
                        <li @click="openInforPost(item.id)"><a href="javascript:void(0)"><i class="icon-info22"></i> Thông tin chi tiết</a></li>
                    </ul>
                </li>
            </ul>
        </td>
    </tr>

</template>
<script>
    import tdCheckbox from './tdCheckbox'

    export default {
        components: {
          'td-checkbox' :tdCheckbox
        },
        props:['item','checkAll'],
        data(){
          return {
              willDelete: false
          }
        },
        methods: {
            push_id_item_selected(id){
                this.willDelete = true
                this.$emit('push_item_selected',id)

            },
            getAvatar(url){
              return window.location.origin+url
            },
            pop_id_item(id){
                this.willDelete = false
                this.$emit('pop_item_selected',id)
            },
            request_delete(){
                this.willDelete = true
                var vm = this
                vm.$emit('request_delete_item',vm.item.id)
            },
            infoEnterprise(email_address_enterprise)
            {
                // return window.location.origin+'/admin/enterprise-manage/info-enterprise?user_enterprise='+email_address_enterprise
            },
            infoPost(id){

            },
            openInforPost(id){
                // window.open(window.location.origin+'/admin/student-manage/info-student?code_student='+code_student,'_blank')
            }
        }
    }
</script>
