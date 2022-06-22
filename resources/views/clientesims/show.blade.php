@extends('app', ['page_title' => "Details Client"])

@section('app_content')
    <clientesim-show :clientesim_prop="{{ $clientesim->toJson() }}"></clientesim-show>
@endsection
