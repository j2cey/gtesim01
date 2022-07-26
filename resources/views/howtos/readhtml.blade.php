@extends('app', ['page_title' => "Détails Rubrique" ])

@section('app_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $howto->title }}</div>

                <div class="card-body">
                    {!! $howto->htmlbody !!}
                </div>
            </div>
        </div>
    </div>
@endsection
