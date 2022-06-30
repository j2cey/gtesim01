@component('mail::message')
# Bonjour.

Bravo ! Vous avez cree avec succes votre e-sim chez Moov-Africa.

@component('mail::panel')
Infos e-sim
@endcomponent

@component('mail::table')
| <!-- -->                | <!-- -->     |
| -------------           |:-------------                                                              |
| Nom/Raison Sociale      | <strong>{{ $client->nom_raison_sociale  }} {{ $client->prenom  }}</strong> |
| Numero Telephone        | <strong>{{ $client->numero_telephone  }}</strong> |
| Code PIN                | <strong>{{ $client->esim->pin  }}</strong> |
| Code PUK                | <strong>{{ $client->esim->puk  }}</strong> |
@endcomponent

@component('mail::panel')
scannez ce QR code pour telecharger votre profile E-SIM
@endcomponent

<p>
    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(150)->generate($client->esim->ac)) }} ">
</p>

Merci,<br>
{{ config('app.name') }}
@endcomponent
