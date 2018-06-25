@extends('layout')
@section('page-content')
    <main-sidebar></main-sidebar>
    <detail-content id-job="{{$id}}"></detail-content>
@endsection
@section("js-page")
    <script type="text/javascript" src="{{asset("assets/js/build/pages/job/list-job/job-detail.js")}}"></script>
@endsection
@section('theme-asset')
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
@endsection