@extends('app', ['page_title' => ""])

@section('app_content')
    <dashboard-details :agence_prop="{{ $agence }}"></dashboard-details>
@endsection
