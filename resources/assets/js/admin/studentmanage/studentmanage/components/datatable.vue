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
                    <th-check-all :selected="false" @delete_selected="delete_selected" @setcheckAll="setCheckAllData"></th-check-all>
                </th>
                <th></th>
                <th>Họ và tên</th>
                <th>Khoa</th>
                <th>Chuyên ngành</th>
                <th>Khóa</th>
                <th>Tốt nghiệp</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody id="table_body">

            <tr-table v-for="item in dataRows" :key="item.id_item" :item="item" :checkAll="checkAll" @request_delete_item="confirm_delete_item($event)"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></tr-table>
            </tbody>
        </table>

        <!-- modal push excel -->
        <div id="modal-push-excel" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content text-center">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm sinh viên bằng Excel</h5>
                    </div>

                    <form v-on:submit.prevent="uploadExcelFile" class="form-inline" enctype="multipart/form-data">

                        <div class="modal-body">
                            <input type="file"class="form-control" @change="setExcelFile($event)">
                            <div class="pace-demo" v-if="ExcelFileuploading == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
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
        <!-- Danger modal -->
        <div id="modal_danger" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h6 class="modal-title"><i class="icon-warning"></i> Cảnh báo</h6>
                    </div>

                    <div class="modal-body">

                        <p> <i class="icon-warning"></i> Sau khi xóa, mọi dữ liệu liên quan sẽ bị xóa. Bạn nên cân nhắc điều này ! </p>
                        <div style="border: snow" class="panel panel-body border-top-danger text-center">
                            <div class="pace-demo" v-if="deleting == true">
                                <div class="theme_xbox_xs"><div class="pace_progress" data-progress-text="60%" data-progress="60"></div><div class="pace_activity"></div></div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-danger" @click="confirm_delete">Xác định xóa</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- /default modal -->
    </div>
</template>
<script>

    import tdCheckbox from './tdCheckbox.vue'
    import thCheckAll from './thCheckAll.vue'
    import trTable from './trTable.vue'
    import store from 'vuex'
    import axios from 'axios'
    export default {
        store,
        components:{
            'td-checkbox' : tdCheckbox,
            'th-check-all': thCheckAll,
            'tr-table': trTable,
        },

        computed: {
            getDataRows(){
                return this.dataRows
            }
        },
        beforeCreate(){


        },
        beforeMount(){
            this.getStudents()
        },
        mounted(){
                this.setDatatable()
            // console.log(this.table.fnGetData())

        },
        beforeUpdate(){
            this.table.fnDestroy()
        },
        updated(){
            this.$nextTick(function () {

                this.setDatatable()
            })
        }
        ,
        methods: {
            setCheckAllData(vl){
                this.checkAll = vl
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
                this.table = $('#table').dataTable({
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
                                    window.open(window.location.origin+'/admin/student-manage/add-student','_blank');

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
                                    window.open(window.location.origin+'/admin/student-manage/get-excel-student','_blank');

                                }
                            }
                        ]
                    }
                });
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
            pop_id_item(id_item){
                this.id_item_selected = this.id_item_selected.filter(value => {
                    return value != id_item
                })
            },
            delete_selected(){
                $('#modal_danger').modal('show')
                // console.log($(item).parents('tr'))
            },
            confirm_delete(){
                var vm = this
                vm.deleting = true
                axios.delete('/api/admin/student-manage/delete-list-student',
                    {
                        params: {
                            list_id_student : vm.id_item_selected
                        }
                    }).then(data => {
                    vm.students = vm.students.filter(value =>{
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
                        text: 'Đã xóa thành công '+vm.id_item_selected.length+' sinh viên',
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
            push_id_item_selected(id){
                this.id_item_selected.push(id)
                this.table.$('tr[will-delete="true"]')
            },
            fnGetSelected( oTableLocal )
            {
                return oTableLocal.$('tr[will-delete="true"]');
            },
            setExcelFile(e){
                var vm = this
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                vm.ExcelFileUpload = files[0]
            },
            uploadExcelFile(){
                    var vm = this
                    this.ExcelFileuploading = true
                    var formData = new FormData()
                    formData.append('ExcelFileUpload',vm.ExcelFileUpload)
                    axios.post('/api/admin/student-manage/add-student-excel',formData).then(data => {
                        vm.ExcelFileuploading = false
                        if(data.data.error.length > 0 || data.data.error == null)
                        {
                            var html_err =''
                            var err = data.data.error
                            err.forEach(item => {
                                html_err+='<br>'
                                html_err+='code_student: '+item.item
                                html_err+='<br>'
                                html_err+='Message : '+item.message
                            })
                            new PNotify({
                                title: 'Cảnh báo! Thêm thành công! Một số dữ liệu trong file bị lỗi',
                                text: data.data.message + '<br> Lỗi tại các vị trí'+html_err,
                                addclass: 'bg-warning',
                                hide: false
                            });
                        }
                        else {
                            new PNotify({
                                title: 'Ohh Yeah! Thành công!',
                                text: data.data.message,
                                addclass: 'bg-success'
                            });

                            setTimeout(function () {
                                window.location.reload()
                            },1000)
                        }
                    }).catch(err => {
                        console.dir(err)
                        new PNotify({
                            title: 'Ohh! Có lỗi xảy ra rồi!',
                            text: err.response.data.message,
                            addclass: 'bg-danger'
                        });
                        this.ExcelFileuploading = false
                    })
            },
            getStudents(){
                var vm = this
                axios.get('/api/admin/student-manage/get-list-student').then(data => {
                   vm.dataRows = data.data
                    vm.students = data.data
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
                axios.delete('/api/admin/student-manage/delete-student',
                    {
                        params: {
                            id : id
                        }
                    }).then(data => {
                    vm.students = vm.students.filter(value =>{
                        return value.id !=id
                    })
                    var rows_selected = vm.fnGetSelected(vm.table)

                    for (var i = 0; i < rows_selected.length; i++) {
                        vm.table.fnDeleteRow(rows_selected[i])
                    };
                    new PNotify({
                        title: 'Ohh Yeah! Thành công!',
                        text: 'Đã xóa thành công sinh viên',
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

            }
        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],
                students: [],
                ExcelFileuploading: false,
                dataRows: [],
                ExcelFileUpload: '',
                deleting: false,

            }
        },
        watch:{
            getDataRows: {
                    handler(old){
                        // console.log(old)
                        // console.log($('#table_body').html())
                    },
                    deep: true
                }
        },
    }
</script>
<style>
    .avatar-user{
        width: 45px;
        height: 60px;
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