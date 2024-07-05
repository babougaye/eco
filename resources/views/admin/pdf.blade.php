<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
</head>
<body>
    <h1>cest un fichier de pdf</h1>
    preom du client:<h3>{{$order->prenom}}</h3>
    nom du client:<h3>{{$order->nom}}</h3>
    email du client :<h3>{{$order->email}}</h3>
    addresse du client:<h3>{{$order->addresse}}</h3>
    telephone du client<h3>{{$order->telephone}}</h3>
    identifiant du client:<h3>{{$order->user_id}}</h3>
    nom du produit<h3>{{$order->titre_produit}}</h3>
    quantite du produit:<h3>{{$order->quantite}}</h3>
    prix du produit:<h3>{{$order->prix}}</h3>
    paiement status<h3>{{$order->status_paiement}}</h3>
    delivere statust:<h3>{{$order->status_delivere}}</h3>
    produit id:<h3>{{$order->produit_id}}</h3>
   <br>
   <img width="200" height="300" src="produit/{{$order->image}}" alt="">

</body>
</html>
