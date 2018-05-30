<template>
    <tr :will-delete="willDelete">
        <td class="check-item">
            <td-checkbox :checkAll="checkAll" :id-item="item.id_item"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
        </td>
        <td class="avatar-user"><img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/c2.0.160.160/p160x160/31671240_879236188913966_190523374861025280_n.jpg?_nc_cat=0&oh=e1976bd62499cf51a828b1644292e072&oe=5B7A89EB" alt=""></td>
        <td><a href="#">{{item.first_name + ' ' +item.last_name}}</a></td>
        <td>{{item.khoa}}</td>
        <td>{{item.khoa_}}</td>
        <td><span class="label label-success">Active</span></td>
        <td class="text-center">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="#"><i class="glyphicon glyphicon-trash"></i> Xóa sinh viên</a></li>
                        <li><a href="#"><i class="icon-info22"></i> Thông tin chi tiết</a></li>
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

            pop_id_item(id){
                this.willDelete = false
                this.$emit('pop_item_selected',id)
            }
        }
    }
</script>
