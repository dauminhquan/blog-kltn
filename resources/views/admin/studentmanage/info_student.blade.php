@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Thông tin sinh viên</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="index.html">Home</a></li>
                <li><a href="{{route('admin.student.manage.index')}}">Quản lý sinh viên</a></li>
                <li class="active">Thông tin sinh viên <b>#1</b> </li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')

    <main-sidebar code_student="{{$code_student}}"></main-sidebar>
    <main-content code_student="{{$code_student}}"></main-content>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/student-manage/info-student.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset("assets/js/plugins/uploaders/dropzone.min.js")}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection