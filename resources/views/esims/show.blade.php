@extends('app', ['page_title' => "Details Esim"])

@section('app_content')
    <esim-show :esim_prop="{{ $esim->toJson() }}"></esim-show>
@endsection
