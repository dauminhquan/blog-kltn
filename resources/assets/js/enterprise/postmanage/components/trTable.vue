

<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td><a :href="infoPost(item.id)">{{item.title_post}}</a></td>
        <td>{{item.created_at}}</td>
        <td><span class="label label-default" v-if="item.accept == -1">Đang đợi</span><span class="label label-success" v-if="item.accept == 1">Đã được đăng</span> <span v-else class="label label-success" >Đang đăng</span> </td>
        <td><span class="label label-info" v-for="position in item.positions">{{position.name_position}}</span></td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li @click="request_delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i> Xóa bài viết</a></li>
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
            infoPost(user_post)
            {
                return window.location.origin+'/enterprise/post-manage/info-post/'+id
            },
            openInforPost(user_post){
                window.open(window.location.origin+'/enterprise/post-manage/info-post/'+id,'_blank')
            }
        }
    }
</script>
