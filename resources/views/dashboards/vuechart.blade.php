@extends('app', ['page_title' => "VueJs Chart"])

@section('app_content')
    <esims-dashboard :chartData_prop="{{ $chartData }}"></esims-dashboard>
@endsection
