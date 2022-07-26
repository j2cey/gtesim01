@extends('app', ['page_title' => "Details Tuto"])

@section('app_content')
    <howtothread-show :howtothread_prop="{{ $howtothread->toJson() }}"></howtothread-show>
@endsection
