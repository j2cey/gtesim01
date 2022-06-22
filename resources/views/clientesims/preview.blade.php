<!DOCTYPE html>
<html>
<head>
    <title>Generate PDF Laravel 8 - phpcodingstuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">

        .body{
            background:#eee;
            margin-top:20px;
        }
        .text-danger strong {
        	color: #9f181c;
		}
		.receipt-main {
			background: #ffffff none repeat scroll 0 0;
			border-bottom: 2px solid #333333;
			border-top: 2px solid #fcf9f9;
			margin-top: 50px;
			margin-bottom: 50px;
			padding: 40px 30px !important;
			position: relative;
			box-shadow: 0 1px 21px #acacac;
			color: #333333;
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
		}
		.receipt-main p {
			color: #333333;
			font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
			line-height: 1.42857;
		}
		.receipt-footer h1 {
			font-size: 15px;
			font-weight: 400 !important;
			margin: 0 !important;
		}
		.receipt-main::after {
			background: #414143 none repeat scroll 0 0;
			content: "";
			height: 5px;
			left: 0;
			position: absolute;
			right: 0;
			top: -13px;
		}
		.receipt-main thead {
			background: #414143 none repeat scroll 0 0;
		}
		.receipt-main thead th {
			color:#fff;
		}
		.receipt-right h5 {
			font-size: 16px;
			font-weight: bold;
			margin: 0 0 7px 0;
		}
		.receipt-right p {
			font-size: 12px;
			margin: 0px;
		}
		.receipt-right p i {
			text-align: center;
			width: 18px;
		}
		.receipt-main td {
			padding: 9px 20px !important;
		}
		.receipt-main th {
			padding: 13px 20px !important;
		}
		.receipt-main td {
			font-size: 13px;
			font-weight: initial !important;
		}
		.receipt-main td p:last-child {
			margin: 0;
			padding: 0;
		}	
		.receipt-main td h2 {
			font-size: 20px;
			font-weight: 900;
			margin: 0;
			text-transform: uppercase;
		}
		.receipt-header-mid .receipt-left h1 {
			font-weight: 100;
			margin: 34px 0 0;
			text-align: right;
			text-transform: uppercase;
		}
		.receipt-header-mid {
			margin: 24px 0;
			overflow: hidden;
		}

		.noborder td, .noborder th {
    		border: none !important;
		}
		
		#container {
			background-color: #dcdcdc;
		}
    
</style>    
<body>
	<div class="container">
		<div class="col-md-12">
			<div class="row">
				<div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
					
					<div>

						<div class="row">
							<table class="table noborder" style="border: 0;">
								<tbody>
									<tr>
										<td class="col-md-8"><h5>Moov-Africa E-sim</h5></td>
										<td class="col-md-4 text-right"><img alt="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/logo.png'))) }}" style="width: 81px; border-radius: 4px;"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<table class="table table-bordered">
							<thead>
								<tr>
									<th colspan="2" class="text text-center">Infos Client</th>
								</tr>
							</thead>
							
							<tbody>
								<tr>
									<td class="col-md-4">Nom / Raison Sociale</td>
									<td class="col-md-8">{{ $client->nom_raison_sociale }}</td>
								</tr>
								<tr>
									<td class="col-md-4">Prenom</td>
									<td class="col-md-8">{{ $client->prenom }}</td>
								</tr>
								<tr>
									<td class="col-md-4">Email</td>
									<td class="col-md-8">{{ $client->email }}</td>
								</tr>
							</tbody>
						</table>
						
						<table class="table table-bordered">
							<thead>
								<tr>
									<th colspan="2" class="text text-center">Indentification Profile E-sim</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-4">Numero Appel</td>
									<td class="col-md-8">{{ $client->numero_telephone }}</td>
								</tr>
								<tr>
									<td class="col-md-4">Numero Serie (IMSI)</td>
									<td class="col-md-8">{{ $client->esim->imsi }}</td>
								</tr>
								<tr>
									<td class="col-md-4">Numero PIN</td>
									<td class="col-md-8">{{ $client->esim->pin }}</td>
								</tr>
								<tr>
									<td class="col-md-4">Numero PUK</td>
									<td class="col-md-8">{{ $client->esim->puk }}</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="row">
						<div class="col text-center">
							<p> <small> Scannez ce QR code pour telecharger votre profile E-SIM </small> </p>
							<p>
								<img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(100)->generate($client->esim->ac)) }} ">
							</p>
							<h6 style="color: rgb(140, 140, 140);"><b>{{ $client->esim->iccid }}</b></h6>
						</div>
					</div>
					@if(!isset($generate_now))
					<div class="row">
						<div class="col-md-6">
							<a href="{{ route('clientesims.show', $client->uuid) }}" class="btn btn-sm btn-secondary text-left">Retour</a>
						</div>
						<div class="col-md-6 text-right">
							<a href="{{ route('clientesims.generatepdf', $client->id) }}" class="btn btn-sm btn-primary text-right">Generer PDF</a>
						</div>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</body>

</html>