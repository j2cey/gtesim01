@extends('app', ['page_title' => $howtostep->howtothread->title ])

@section('app_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    
                    <div class="col-md-4 col-sm-4 border-right">
                        
                        <div class="description-block">
                            @if($howtostepprev)
                            <h5 class="description-header">
                                <a href="{{ route('howtosteps.read', $howtostepprev->id) }}">
                                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ $howtostepprev->title }}</span>
                            @endif
                        </div>
                        
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header"><i class="fa fa-circle" aria-hidden="true"></i></h5>
                            <span class="text text-xs">{{ $howtostep->title }}</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-4">
                        <div class="description-block">
                        @if($howtostepnext)
                            <h5 class="description-header">
                                <a href="{{ route('howtosteps.read', $howtostepnext->id) }}">
                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                </a>
                            </h5>
                            <span class="text text-xs">{{ $howtostepnext->title }}</span>
                        @else
                        <h5 class="description-header">
                            <a href="{{ route('howtothreads.index') }}">
                                <i class="fa fa-stop-circle" aria-hidden="true"></i>
                            </a>
                        </h5>
                        <span class="text text-xs">Terminé</span>
                        @endif
                        </div>
                        <!-- /.description-block -->
                    </div>

                </div>

                <div class="card-body">
                    {!! $howtostep->howto->htmlbody !!}
                </div>
            </div>
        </div>
    </div>
@endsection
