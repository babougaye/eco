<!DOCTYPE html>
<html>
<head>
    <base href="/public">
    <title>Paiement Orange Money</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Ndama Service</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="hero_area">
        <span style="font-size: 18px;"> @include('home.header')</span>
        <div class="container">
            <h1 style="text-align: center; font-size: 24px; padding-bottom:20px;"> Paiement Orange Money - Montant total {{$totalprix}}</h1>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table">
                            <h3 class="panel-title">Détails du paiement</h3>
                        </div>
                        <div class="panel-body">
                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                            <form
                                role="form"
                                action="{{ route('orange_money.post', $totalprix) }}"
                                method="post"
                                class="require-validation"
                                id="payment-form">
                                @csrf
                                <!-- Formulaire spécifique à Orange Money -->
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Numéro de téléphone</label>
                                        <input class='form-control' size='4' type='text' name="phone_number">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="submit" value="Payer maintenant" class="btn btn-warning">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
