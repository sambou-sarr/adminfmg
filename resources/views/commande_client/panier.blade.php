<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Panier - Zero Faute</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- HEADER -->
<header class="bg-white shadow p-4 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <img src="/images/logo_firstmedia.png" alt="Logo First Media" class="w-16 h-16 object-contain">
        <h1 class="text-2xl font-bold text-gray-800">Zero Faute - Panier</h1>
    </div>
    <nav class="space-x-4">
        <a href="/" class="text-gray-600 hover:text-blue-600 font-medium">Accueil</a>
        <a href="/a-propos" class="text-gray-600 hover:text-blue-600 font-medium">À propos</a>
        <a href="/emissions" class="text-gray-600 hover:text-blue-600 font-medium">Émissions</a>
        <a href="/services" class="text-gray-600 hover:text-blue-600 font-medium">Services</a>
    </nav>
</header>

<div class="max-w-4xl mx-auto my-10">

    <!-- PANIER -->
    <h1 class="text-3xl font-bold mb-6">Votre panier</h1>
    <div class="bg-white rounded-2xl shadow-xl p-6" id="cart">
        <div id="products">
            @php $total = 0; @endphp
            @foreach($produits as $produit)
                @php $total += $produit->prix; @endphp
                <div class="flex items-center gap-4 py-4 border-b last:border-b-0 hover:bg-gray-50 transition product-item" data-id="{{ $produit->id }}">
                    <img src="{{ $produit->image_url ?? 'https://via.placeholder.com/80' }}" class="w-24 h-24 rounded-lg object-cover">
                    <div class="flex-1">
                        <h3 class="font-semibold text-lg text-gray-800">{{ $produit->nom }}</h3>
                        <div class="mt-2 flex items-center gap-3">
                            <div class="flex items-center gap-2">
                                <button class="px-3 py-1 bg-gray-200 rounded-full qty-btn" data-action="decrease">-</button>
                                <span class="font-medium qty">1</span>
                                <button class="px-3 py-1 bg-gray-200 rounded-full qty-btn" data-action="increase">+</button>
                            </div>
                            <p class="font-bold text-lg text-green-600 price">{{ number_format($produit->prix,0,',',' ') }} CFA</p>
                        </div>
                    </div>
                    <button class="text-red-500 hover:text-red-700 text-2xl remove transition">×</button>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-between items-center text-xl font-semibold">
            <span>Total</span>
            <span class="text-2xl font-bold text-green-600" id="total">{{ number_format($total,0,',',' ') }} CFA</span>
        </div>

        <div class="mt-8">
            <a href="#formulaire" class="w-full block bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-2xl font-semibold">
                Passer à la commande →
            </a>
        </div>
    </div>

    <!-- FORMULAIRE CLIENT -->
    <div id="formulaire" class="bg-white mt-10 p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold mb-4">Informations Client</h2>
        <form action="{{ route('commande.envoi') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="font-medium">Nom *</label>
                    <input type="text" name="nom" class="input" placeholder="Ex: Sarr" required>
                </div>
                <div>
                    <label class="font-medium">Prénom *</label>
                    <input type="text" name="prenom" class="input" placeholder="Ex: Abdoulaye" required>
                </div>
                <div>
                    <label class="font-medium">Email *</label>
                    <input type="email" name="email" class="input" placeholder="Ex: email@domaine.com" required>
                </div>
                <div>
                    <label class="font-medium">Téléphone *</label>
                    <input type="tel" name="telephone" class="input" placeholder="Ex: 77 123 45 67" required>
                </div>
                <div class="col-span-2">
                    <label class="font-medium">Adresse *</label>
                    <textarea name="adresse" class="input" placeholder="Votre adresse complète" required></textarea>
                </div>
                <div class="col-span-2">
                    <label class="font-medium">Choix de paiement *</label>
                    <select name="choix_paiement" class="input" required>
                        <option>Wave</option>
                        <option>Orange Money</option>
                        <option>Free Money</option>
                        <option>Paiement à la livraison</option>
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="font-medium">Méthode de livraison *</label>
                    <select name="choix_livraison" class="input" required>
                        <option>Livraison à domicile</option>
                        <option>Point de retrait</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="mt-6 w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-2xl font-semibold text-lg">
                Valider la commande
            </button>
        </form>
    </div>
</div>

<!-- FOOTER -->
<footer class="bg-gray-50 mt-10 p-6 rounded-xl shadow-inner text-gray-700 text-sm">
    <div class="flex flex-col md:flex-row justify-between gap-4">
        <div>
            <h3 class="font-bold mb-2">Contact</h3>
            <p>03 rue Béranger Féraud, CTIC, Dakar</p>
            <p>+221 77 631 78 92</p>
            <p>firstmediag@gmail.com</p>
        </div>
        <div>
            <h3 class="font-bold mb-2">Suivez-nous</h3>
            <div class="flex gap-3">
                <a href="#" class="hover:text-blue-600">Facebook</a>
                <a href="#" class="hover:text-pink-600">Instagram</a>
                <a href="#" class="hover:text-blue-400">Twitter</a>
            </div>
        </div>
    </div>
    <p class="mt-4 text-center">© FIRST MEDIA Group — Tous droits réservés</p>
</footer>

<!-- SCRIPT PANIER -->
<script>
const cart = document.getElementById('cart');
const totalEl = document.getElementById('total');

function updateTotal() {
    let total = 0;
    cart.querySelectorAll('.product-item').forEach(item => {
        const qty = parseInt(item.querySelector('.qty').innerText);
        const price = parseInt(item.querySelector('.price').innerText.replace(/\s/g,'').replace('CFA',''));
        total += qty * price;
    });
    totalEl.innerText = total.toLocaleString() + ' CFA';
}

cart.addEventListener('click', (e) => {
    const target = e.target;
    const parent = target.closest('.product-item');
    if(!parent) return;

    if(target.classList.contains('qty-btn')){
        let qtyEl = parent.querySelector('.qty');
        let qty = parseInt(qtyEl.innerText);
        qty = target.dataset.action === 'increase' ? qty + 1 : qty - 1;
        if(qty < 1) qty = 1;
        qtyEl.innerText = qty;
        updateTotal();
    }

    if(target.classList.contains('remove')){
        parent.remove();
        updateTotal();
    }
});
</script>

<!-- STYLE INPUTS -->
<style>
.input {
    @apply w-full p-3 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-400 focus:outline-none;
}
.qty, .price {
    transition: all 0.2s ease;
}
.product-item:hover {
    transform: translateY(-2px);
    transition: all 0.2s ease;
}
</style>

</body>
</html>
