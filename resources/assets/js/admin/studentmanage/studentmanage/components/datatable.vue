<template>
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Danh sách sinh viên</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <table id="table" class="table datatable-button-html5-columns">
            <thead>
            <tr>
                <th class="check-all">
                    <th-check-all :selected="false" @setcheckAll="setCheckAllData"></th-check-all>
                </th>
                <th></th>
                <th>Họ và tên</th>
                <th>Khoa</th>
                <th>Khóa</th>
                <th>Tốt nghiệp</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="check-item">
                   <td-checkbox :checkAll="checkAll" id-item="1" @push_item_selected="id_item_selected.push($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
                </td>
                <td class="avatar-user"><img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/c2.0.160.160/p160x160/31671240_879236188913966_190523374861025280_n.jpg?_nc_cat=0&oh=e1976bd62499cf51a828b1644292e072&oe=5B7A89EB" alt=""></td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
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
            <tr>
                <td class="check-item">
                    <td-checkbox :checkAll="checkAll" id-item="2" @push_item_selected="id_item_selected.push($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
                </td>
                <td class="avatar-user"><img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/c2.0.160.160/p160x160/31671240_879236188913966_190523374861025280_n.jpg?_nc_cat=0&oh=e1976bd62499cf51a828b1644292e072&oe=5B7A89EB" alt=""></td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
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
            <tr>
                <td class="check-item">
                    <td-checkbox :checkAll="checkAll" id-item="3" @push_item_selected="id_item_selected.push($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
                </td>
                <td class="avatar-user"><img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/c2.0.160.160/p160x160/31671240_879236188913966_190523374861025280_n.jpg?_nc_cat=0&oh=e1976bd62499cf51a828b1644292e072&oe=5B7A89EB" alt=""></td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
                <td><span class="label label-success">Active</span></td>
                <td class="text-center">
                    <ul class="icons-list">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="icon-menu9"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li @click="demodelete()" id="test-delete"><a href="javascript:void(0)"><i class="glyphicon glyphicon-trash" ></i> Xóa sinh viên</a></li>
                                <li><a href="#"><i class="icon-info22"></i> Thông tin chi tiết</a></li>
                            </ul>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="check-item">
                    <td-checkbox :checkAll="checkAll" id-item="4" @push_item_selected="id_item_selected.push($event)" @pop_item_selected="pop_id_item($event)"></td-checkbox>
                </td>
                <td class="avatar-user"><img src="https://scontent.fhan3-3.fna.fbcdn.net/v/t1.0-1/c2.0.160.160/p160x160/31671240_879236188913966_190523374861025280_n.jpg?_nc_cat=0&oh=e1976bd62499cf51a828b1644292e072&oe=5B7A89EB" alt=""></td>
                <td><a href="#">Enright</a></td>
                <td>Traffic Court Referee</td>
                <td>22 Jun 1972</td>
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
            </tbody>
        </table>

        <!-- modal push excel -->
        <div id="modal-push-excel" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm sinh viên bằng Excel</h5>
                    </div>

                    <form action="#" class="form-inline">

                        <div class="modal-body">
                            <input type="file"class="form-control">
                        </div>
                        <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">Tải file lên <i class="icon-plus22"></i></button>
                            <button type="button" class="btn btn-info">Tải Excel mẫu <i class="glyphicon glyphicon-info-sign"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /inline form modal -->

    </div>
</template>
<script>

    import tdCheckbox from './tdCheckbox.vue'
    import thCheckAll from './thCheckAll.vue'
    export default {
        components:{
            'td-checkbox' : tdCheckbox,
            'th-check-all': thCheckAll
        },

        computed: {

        },
        mounted(){
            this.setDatatable()

        },
        methods: {
            setCheckAllData(vl){
                this.checkAll = vl
            },
            setdata(){
                this.table.destroy()
            },
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
                this.table = $('#table').DataTable({
                    columnDefs: [ { orderable: false, targets: [0,1,6] }],
                    buttons: {
                        buttons: [
                            {
                                extend: 'colvis',
                                text: '<i class="icon-three-bars"></i> <span class="caret"></span>',
                                className: 'btn bg-blue btn-icon'
                            },
                            {
                                text: 'Thêm mới',
                                className: 'btn bg-primary',
                                action: function(e, dt, node, config) {
                                    window.open('https://facebook.com','_blank');

                                }
                            },
                            {
                                text: 'Thêm bằng Excel',
                                className: 'btn bg-success',
                                action: function(e, dt, node, config) {
                                    $('#modal-push-excel').modal('show')

                                }
                            },
                            {
                                text: 'Tải xuống Excel',
                                className: 'btn bg-purple',
                                action: function(e, dt, node, config) {
                                    swal({
                                        title: "Good job!",
                                        text: "Custom button activated",
                                        confirmButtonColor: "#66BB6A",
                                        type: "success"
                                    });

                                }
                            }
                        ]
                    }
                });
                // Add placeholder to the datatable filter option
                $('.dataTables_filter input[type=search]').attr('placeholder','Type to filter...');


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
            pop_id_item(id_item){
                this.id_item_selected = this.id_item_selected.filter(value => {
                    return value != id_item
                })
            },
            demodelete(){
                // console.log($(item).parents('tr'))
                this.table.row( $().parents('tr') )
                    .remove()
                    .draw();
            }
        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],

            }
        },
        watch:{

        },
    }
</script>
<style>
    .avatar-user{
        width: 50px;
    }
    .avatar-user img{
        border-radius: 50%;
        width: 50px;
    }
    .check-all{
        width: 200px
    }
    .check-item div.checker{
        margin-left: 30px;
    }
</style>