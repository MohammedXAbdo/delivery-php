
@extends('layouts.app', ['title' => 'Dashboard'])

@section('css')
    <!-- Plugins css -->
    {{--<link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />--}}
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">


    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>
@endsection
