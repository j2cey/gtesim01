@extends('app', ['page_title' => $howtothread->title])

@section('app_content')
    <howtothread-read :howtothread_prop="{{ $howtothread->toJson() }}"></howtothread-read>
@endsection