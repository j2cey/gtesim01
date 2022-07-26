@extends('app', ['page_title' => "Edition HTML Rubrique"])

@section('app_content')
    <howto-edithtml :howto_prop="{{ $howto->toJson() }}"></howto-edithtml>
@endsection
