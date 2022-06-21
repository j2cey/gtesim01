<!DOCTYPE html>
<html>
<head>
    <title>Generate PDF Laravel 8 - phpcodingstuff.com</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style type="text/css">

        
    
</style>    
<body>
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="receipt-main col-xs-10 col-sm-10 col-md-6 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                <div class="row">
                    <div class="col-xs-3 col-sm-3 col-md-8 text-left">
                        <div class="receipt-left">
                            <h5>Moov-Africa E-sim</h5>
                        </div>
                        </div>

                        <div class="col-xs-3 col-sm-3 col-md-4 text-right">
                            <div class="receipt-right">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="https://bootdey.com/img/Content/avatar/avatar6.png" style="width: 71px; border-radius: 43px;">
                            </div>
                        </div>
                    </div>
                    <br />
                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text text-center">Infos Client</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9">Nom / Raison Sociale</td>
                                    <td class="col-md-3">5566</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Prenom</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 6,00/-</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Email</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 35,00/-</td>
                                </tr>
                                
                            </tbody>
                        </table>
                        
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2" class="text text-center">Infos Client</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-9">Indentification Profile E-sim</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 15,000/-</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Numero Appel</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 6,00/-</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Numero Serie (IMSI)</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 35,00/-</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Numero PIN</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 35,00/-</td>
                                </tr>
                                <tr>
                                    <td class="col-md-9">Numero PUK</td>
                                    <td class="col-md-3"><i class="fa fa-inr"></i> 35,00/-</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
			
                    <div class="row">
                        <div class="col text-center">
                            <p>Date : 15 Aug 2016</p>
                            <h6 style="color: rgb(140, 140, 140);"><b>Thanks for shopping.!</b></h6>
                        </div>
                    </div>
                </div>    
	        </div>
        </div>
    </div>
<div class="text-center pdf-btn">
  <a href="{{ route('pdf.generate') }}" class="btn btn-primary">Generate PDF</a>
</div>
</body>

</html>