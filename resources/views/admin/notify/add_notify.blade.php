@extends('layout.manage_layout')
@section('header-content')
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Đăng thông báo</span></h4>

            <ul class="breadcrumb breadcrumb-caret position-right">
                <li><a href="{{route('home')}}">Home</a></li>
                <li><a href="{{route('admin.notify.manage.notifies')}}">Quản lý thông báo</a></li>
                <li class="active">Thêm thông báo</li>
            </ul>
        </div>

    </div>
@endsection
@section('page-content')
    <content-wrapper></content-wrapper>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/admin/notify/add-notify.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/ckeditor/ckeditor.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
@endsection