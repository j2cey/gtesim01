<?php

use App\Models\Esims\Esim;
use Tabuna\Breadcrumbs\Trail;
use App\Models\Esims\ClientEsim;
use Tabuna\Breadcrumbs\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

#region System
// System
Breadcrumbs::for('systems.index', function (Trail $trail) {
    $trail->parent('home')->push('System', route('systems.index'));
});
#endregion

#region Esims
// Reports
Breadcrumbs::for('esims.index', function (Trail $trail) {
    $trail->parent('home')->push('E-sims', route('esims.index'));
});
// esims.show
Breadcrumbs::for('esims.show', function (Trail $trail, Esim $esim) {
    $trail->parent('esims.index')
        ->push($esim->imsi, route('esims.show', $esim->uuid));
});
#endregion

#region Clients Esim
// clientesims
Breadcrumbs::for('clientesims.index', function (Trail $trail) {
    $trail->parent('home')->push('Clients e-sim', route('clientesims.index'));
});
// clientesims.show
Breadcrumbs::for('clientesims.show', function (Trail $trail, ClientEsim $clientesim) {
    $trail->parent('clientesims.index')
        ->push($clientesim->nom_raison_sociale, route('clientesims.show', $clientesim->uuid));
});
#endregion