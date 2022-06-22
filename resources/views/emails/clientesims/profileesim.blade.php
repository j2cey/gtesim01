@component('mail::message')
# Introduction

Bonjour.

Bravo ! Vous avez cree avec succes votre e-sim chez Moov-Africa.

Trouvez, ci-dessous les informations necessaires:

<p>
    Nom/Raison Sociale : <strong>{{ $client->nom_raison_sociale  }} {{ $client->prenom  }}</strong>
    Numero Telephone : <strong>{{ $client->numero_telephone  }}</strong>
    Code PIN : <strong>{{ $client->pin  }}</strong>
    Code PUK : <strong>{{ $client->puk  }}</strong>
</p>

<p>
    scannez le QR code pour telecharger votre profile E-SIM
    {{ $qrcode  }}
</p>

Merci,<br>
{{ config('app.name') }}
@endcomponent
