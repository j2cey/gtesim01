@extends('app', ['page_title' => "Dashboard" ])

@section('app_content')
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">eSIM Libres</span>
                        <span class="info-box-number">{{  $esimslibres->count()  }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">eSIM affectées</span>
                        <span class="info-box-number">{{  $esimsattribuees->count()  }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Clients eSIM</span>
                        <span class="info-box-number">{{  $clientsesim->count()  }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Utilisateurs actifs</span>
                        <span class="info-box-number">{{  $usersactive->count()  }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recap Mensuel</h5>

                        <div class="card-tools">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Affectations Mensuel</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <div id="pop_div"></div>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top Agences</strong>
                                </p>

                                @for ($i = 0; $i < 3; $i++)
                                    @switch($i)
                                        @case(0)
                                            <div class="progress-group">
                                                <span class="progress-text">{{ $agencesactives_m[$i]['label'] }}</span>
                                                <span class="float-right"><b>{{ $agencesactives_m[$i]['count'] }}</b>/{{ $esimsaffectees_m_count }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-success" style="width: {{ $agencesactives_m[$i]['rate'] . '%' }};"></div>
                                                </div>
                                            </div>
                                            @break
                                    
                                        @case(1)
                                            <div class="progress-group">
                                                {{ $agencesactives_m[$i]['label'] }}
                                                <span class="float-right"><b>{{ $agencesactives_m[$i]['count'] }}</b>/{{ $esimsaffectees_m_count }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-warning" style="width: {{ $agencesactives_m[$i]['rate'] . '%' }};"></div>
                                                </div>
                                            </div>
                                            @break
                                        @case(2)
                                            <div class="progress-group">
                                                {{ $agencesactives_m[$i]['label'] }}
                                                <span class="float-right"><b>{{ $agencesactives_m[$i]['count'] }}</b>/{{ $esimsaffectees_m_count }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-danger" style="width: {{ $agencesactives_m[$i]['rate'] . '%' }};"></div>
                                                </div>
                                            </div>
                                            @break
                                        @default
                                            <div class="progress-group">
                                                {{ $agencesactives_m[$i]['label'] }}
                                                <span class="float-right"><b>{{ $agencesactives_m[$i]['count'] }}</b>/{{ $esimsaffectees_m_count }}</span>
                                                <div class="progress progress-sm">
                                                    <div class="progress-bar bg-primary" style="width: {{ $agencesactives_m[$i]['rate'] . '%' }};"></div>
                                                </div>
                                            </div>  
                                    @endswitch

                                @endfor
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Recap Hebdomadaire</h5>

                        <div class="card-tools">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Affectations Hebdo</strong>
                                </p>

                                <div class="chart">

                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Top Agences</strong>
                                </p>

                                <div class="progress-group">
                                    Add Products to Cart
                                    <span class="float-right"><b>160</b>/200</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->

                                <div class="progress-group">
                                    Complete Purchase
                                    <span class="float-right"><b>310</b>/400</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: 75%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <span class="progress-text">Visit Premium Page</span>
                                    <span class="float-right"><b>480</b>/800</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" style="width: 60%"></div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    Send Inquiries
                                    <span class="float-right"><b>250</b>/500</span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/. container-fluid -->
@endsection

@section('more_scripts')
    {!! $lava->render('BarChart', 'Stocks', 'pop_div') !!}
@endsection
