<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Suivi de commande</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        label {
            display: block;
            margin: 15px 0 5px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Commande {{ $commande->numero_commande }}</h1>
        <p>Nom : {{ $commande->prenom }} {{ $commande->nom }}</p>
        <p>Email : {{ $commande->email }}</p>
        <p>Adresse : {{ $commande->adresse }}</p>
        <p>Quantité : {{ $commande->quantite }}</p>
        <p>Statut : {{ $commande->statut }}</p>

<!-- Formulaire pour confirmer directement la commande -->
<form action="{{ route('commande.update', $commande->token) }}" method="POST" style="display:inline-block;">
    @csrf
    <input type="hidden" name="statut" value="confirmer">
    <button type="submit" style="
        background-color: #28a745;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    ">Confirmer</button>
</form>

    </div>
</body>
</html>
