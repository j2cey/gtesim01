@extends('app', ['page_title' => $howtothread->title])

@section('app_content')
    <howtothread-read :user_prop="{{ auth()->user() }}" :howtothread_prop="{{ $howtothread->toJson() }}"></howtothread-read>
@endsection