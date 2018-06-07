<template>
    <div class="tab-pane fade" id="list_post">

        <!-- Orders history -->
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">Thông tin về công việc</h6>

            </div>


            <div class="table-responsive">
                <table id="table" class="table tasks-list table-lg">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tiêu đề bài đăng</th>
                        <th>Ngày đăng</th>
                        <th>Tình trạng</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="row in dataRows">
                        <td>{{row.id}}</td>
                        <td>
                            <div class="text-semibold"><a href="task_manager_detailed.html">{{row.title_post}}</a></div>
                            <div class="text-muted">{{row.description_post}}</div>
                        </td>
                        <td>
                            <div class="input-group input-group-transparent">
                                <div class="input-group-addon"><i class="icon-calendar2 position-left"></i></div>
                                {{row.created_at}}
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="#" class="label label-danger" v-if="row.accept == 0">Không được đăng</a>
                                <a href="#" class="label label-default" v-if="row.accept == -1">Đang đợi</a>
                                <a href="#" class="label label-success" v-if="row.accept == 1">Đã đăng</a>

                            </div>
                        </td>



                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu9"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">

                                        <li><a href="#"><i class="icon-search4"></i> Xem chi tiết bài viết</a></li>
                                        <li><a href="#"><i class="icon-trash"></i> Xóa bài viết</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /orders history -->

    </div>

</template>

<script>
    import axios from 'axios'
    export default {
        mounted(){
            this.setDatatable()
            this.getPosts()
        },
        props: ['email_address_enterprise']
        ,
        beforeUpdate(){
            this.table.fnDestroy()
        },
        updated(){
            this.$nextTick(function () {

                this.setDatatable()
            })
        },
        methods: {
            setDatatable()
            {
                $.extend( $.fn.dataTable.defaults, {
                    autoWidth: false,
                    dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
                    language: {
                        search: '<span>Tìm kiếm:</span> _INPUT_',
                        lengthMenu: '<span>Hiển thị:</span> _MENU_',
                        paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
                    }
                });
                this.table = $('#table').dataTable({});
                // Add placeholder to the datatable filter option
                $('.dataTables_filter input[type=search]').attr('placeholder','Nhập từ khóa');


                // Enable Select2 select for the length option
                $('.dataTables_length select').select2({
                    minimumResultsForSearch: Infinity,
                    width: 'auto'
                });
                $('a.dt-button.buttons-collection.buttons-colvis.btn.bg-blue.btn-icon[tabindex="0"][aria-controls="table"]').click(function () {
                    if($(this).attr('removed') == undefined)
                    {
                        $('a.dt-button.buttons-columnVisibility.active[tabindex="0"]')[0].remove()
                        $(this).attr('removed',1)
                    }

                })

            },
            confirm_delete(){
                var vm = this
                vm.deleting = true
                axios.delete('/api/admin/post-manage/delete-list-post',
                    {
                        params: {
                            list_id_post : vm.id_item_selected
                        }
                    }).then(data => {
                    vm.posts = vm.posts.filter(value =>{
                        return vm.id_item_selected.indexOf(value.id) == -1
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };

                    vm.deleting = false
                    $('#modal_danger').modal('hide')
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công '+vm.id_item_selected.length+' doanh nghiệp',
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
                })

            },

            getPosts(){
                var vm = this
                axios.get('/api/admin/post-manage/get-list-post',{
                    params:{
                        email_address_enterprise: vm.email_address_enterprise
                    }
                }).then(data => {
                    vm.dataRows = data.data
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: err.response.data,
                        addclass: 'bg-danger'
                    });
                })
            },
            confirm_delete_item(id){
                var vm = this
                vm.deleting = true
                axios.delete('/api/admin/post-manage/delete-post',
                    {
                        params: {
                            id : id
                        }
                    }).then(data => {
                    vm.posts = vm.posts.filter(value =>{
                        return value.id !=id
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công doanh nghiệp',
                        addclass: 'bg-success'
                    });
                    vm.id_item_selected = []
                }).catch(err => {
                    new PNotify({
                        title: 'Ohh! Có lỗi xảy ra rồi!',
                        text: 'Đã có lỗi từ serve',
                        addclass: 'bg-danger'
                    });
                })

            },
        },
        data(){
            return {
                table: '',
                dataRows: []
            }
        }
    }
</script>

