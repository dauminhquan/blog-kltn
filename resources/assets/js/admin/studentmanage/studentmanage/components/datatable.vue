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
                <th>Khóa</th>
                <th>Tốt nghiệp</th>

                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>

            <tr-table v-for="item in dataRows" :key="item.id_item" :item="item" :checkAll="checkAll"  @push_item_selected="push_id_item_selected($event)" @pop_item_selected="pop_id_item($event)"></tr-table>
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

    </div>
</template>
<script>

    import tdCheckbox from './tdCheckbox.vue'
    import thCheckAll from './thCheckAll.vue'
    import trTable from './trTable.vue'
    import axios from 'axios'
    export default {
        components:{
            'td-checkbox' : tdCheckbox,
            'th-check-all': thCheckAll,
            'tr-table': trTable,
        },

        computed: {

        },
        beforeMount(){
            this.dataRows = this.data_test
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
                // console.log($(item).parents('tr'))
                var vm = this

                vm.data_test = vm.data_test.filter(value =>{
                    return vm.id_item_selected.indexOf(value.id_item) == -1
                })
                var rows_selected = vm.fnGetSelected(vm.table)

                for (var i = 0; i < rows_selected.length; i++) {
                    vm.table.fnDeleteRow(rows_selected[i])
                };

                vm.id_item_selected = []
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
                vm.ExcelFileUpload = e.target.files[0]
            },
            uploadExcelFile(){
                    var vm = this
                    this.ExcelFileuploading = true
                    axios.get('/').then(data => {
                        this.ExcelFileuploading = false
                    }).catch()
            }
        },
        data(){
            return {
                checkAll: false,
                table: '',
                id_item_selected: [],
                data_test: [
                    {
                        id_item: 1,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân1',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 2,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân2',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 3,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân3',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 4,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân4',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 5,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân5',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 6,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân6',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 7,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân7',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 8,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân8',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 9,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân9',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 10,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân10',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 11,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân11',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 12,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân12',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 13,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân13',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 14,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân14',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 15,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân15',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 16,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân16',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    },
                    {
                        id_item: 17,
                        avatar: '',
                        first_name: 'Đậu',
                        last_name:'Quân17',
                        khoa: 'Toán tin',
                        khoa_: 'k27',
                        tot_nghiep: 'active'
                    }
                ],
                ExcelFileuploading: false,
                dataRows: [],
                ExcelFileUpload: ''

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