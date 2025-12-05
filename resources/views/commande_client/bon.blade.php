<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bon de commande {{ $commande->numero_commande }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #007b43; /* vert FMG */
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        header img {
            height: 70px;
        }

        header .company-info {
            text-align: right;
            font-size: 12px;
            color: #555;
        }

        header h1 {
            font-size: 28px;
            color: #007b43;
            margin: 0;
        }

        .info-section {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        ,
        .info-section .client {
            width: 500px;
            flex: 1;
            font-size: 14px;
        }
        .info-section .commande{
            position: absolute;
            left: 400px;
            width: 50%;
            flex: 1;
            font-size: 14px;

        }
        .info-section h3 {
            margin-bottom: 10px;
            color: #004fa3;
            font-size: 16px;
            border-bottom: 2px solid #004fa3;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 14px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #e6f0ff;
        }

        .total-section {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
            color: #007b43;
        }

        .footer {
            margin-top: 40px;
            font-size: 11px;
            color: #555;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            text-align: center;
        }

        .footer .social img {
            height: 25px;
            margin-right: 10px;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }

        .en_attente { background-color: #f0ad4e; }
        .confirmer { background-color: #004fa3; }
        .en_cours { background-color: #5bc0de; }
        .livrer { background-color: #007b43; }
        .annuler { background-color: #d9534f; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="company-info">
                <strong>FIRST MEDIA Group</strong><br>
                Siège social: Dakar, Sénégal<br>
                NINAE: 1234567890<br>
                RCCM: SN-DKR-2025-B12345<br>
                Forme juridique: SARL<br>
                Capital social: 5 000 000 FCFA<br>
                Email: contact@fmg.com<br>
                Tel: +221 77 123 45 67
            </div>
        </header>
        <img src="{{ asset('images/firstlogo.png') }}" alt="logo" style="width:120px;">

         <div class="info-section">
            <!-- Infos Commande à gauche -->
            <div class="commande">
                <h3>Infos Commande</h3>
                <p><strong>N° Facture :</strong> {{ $commande->numero_commande }}</p>
                <p><strong>Date de commande :</strong>  12/11/2025</p>
                <p><strong>Date de livraison :</strong>  12/11/2025</p>
                <p><strong>Statut :</strong> <span class="badge {{ str_replace(' ', '_', $commande->statut) }}">{{ $commande->statut }}</span></p>
                <p><strong>Mode de paiement :</strong> Wave</p>
            </div>

            <!-- Infos Client à droite -->
            <div class="client">
                <h3>Infos Client</h3>
                <p><strong>Nom :</strong>  {{ $commande->nom }}</p>
                <p><strong>Prenom :</strong>  {{ $commande->prenom }}</p>
                <p><strong>Email :</strong> {{ $commande->email }}</p>
                <p><strong>Téléphone :</strong> {{ $commande->telephone }}</p>
                <p><strong>Adresse :</strong> {{ $commande->adresse }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Réf Produit</th>
                    <th>Description</th>
                    <th>Quantité</th>
                    <th>Unité</th>
                    <th>PU</th>
                    <th>TVA</th>
                    <th>TTC</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($commande->produits) && $commande->produits->count() > 0)
                    @foreach($commande->produits as $produit)
                        <tr>
                            <td>{{ $produit->reference ?? '' }}</td>
                            <td>{{ $produit->description ?? $produit->notes }}</td>
                            <td>{{ $produit->quantite }}</td>
                            <td>{{ $produit->unite ?? 'unité' }}</td>
                            <td>{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $produit->tva ?? 0 }}%</td>
                            <td>{{ number_format($produit->prix_ttc, 0, ',', ' ') }} FCFA</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">
                            <strong>{{ $commande->notes }}</strong> - {{ $commande->quantite }} unité(s)
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="total-section">
            Montant total : {{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA
        </div>

        <div class="footer">
            <div>Merci pour votre confiance !</div>
            <div class="social">
                <a href="https://facebook.com/fmg"><img src="{{ asset('storage/facebook.png') }}" alt="Facebook"></a>
                <a href="https://twitter.com/fmg"><img src="{{ asset('storage/twitter.png') }}" alt="Twitter"></a>
                <a href="https://instagram.com/fmg"><img src="{{ asset('storage/instagram.png') }}" alt="Instagram"></a>
            </div>
            <div style="margin-top:10px;">
                QR Code de la page officielle : <img src="{{ asset('storage/qrcode_fmg.png') }}" alt="QR Code" height="80">
            </div>
            <div style="margin-top:15px; font-size:10px;">
                FIRST MEDIA Group - Tous droits réservés - NINAE: 1234567890 - RCCM: SN-DKR-2025-B12345 - SARL - Capital social: 5 000 000 FCFA
            </div>
        </div>
    </div>
</body>
</html>
