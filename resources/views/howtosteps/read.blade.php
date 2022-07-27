@extends('app', ['page_title' => $howtostep->howtothread->title ])

@section('app_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    <div class="row">
                        <div class="col col-sm-4 border-right">
                            @if($howtostepprev)
                            <div class="description-block">
                                <h5 class="description-header"><i class="fa fa-arrow-left"></i></h5>
                                <span class="text text-sm">{{ $howtostepprev->title }}</span>
                            </div>
                            @endif
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">
                                    <span><i class="fa fa-times-circle-o text-danger"></i></span>
                                </h5>
                                <span class="text text-sm">{{ $howtostep->title }}</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-4">
                            @if($howtostepnext)
                            <div class="description-block">
                                <h5 class="description-header"><i class="fa fa-arrow-right"></i></h5>
                                <span class="text text-sm">{{ $howtostepnext->title }}</span>
                            </div>
                            @endif
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>


                </div>

                <div class="card-body">
                    {!! $howtostep->howto->htmlbody !!}
                </div>
            </div>
        </div>
    </div>
@endsection
