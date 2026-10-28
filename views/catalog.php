<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librairie Papeterie Marame - Vente de Matériel Scolaire</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="bg-base-200 min-h-screen">

    <!-- En-tête / Navbar -->
    <div class="navbar bg-base-100 shadow-md px-6 sticky top-0 z-50">
        <div class="flex-1">
            <a class="text-xl font-extrabold text-primary flex items-center gap-2">
                📚 <span>Librairie Papeterie Marame</span>
            </a>
        </div>
        <div class="flex-none">
            <!-- Bouton Panier -->
            <button onclick="document.getElementById('cart-section').scrollIntoView({ behavior: 'smooth' });" class="btn btn-primary btn-sm gap-2 shadow">
                🛒 Mon Panier <span id="cart-count" class="badge badge-sm badge-secondary">0</span>
            </button>
        </div>
    </div>

    <!-- Bannière de Bienvenue -->
    <div class="hero bg-gradient-to-r from-primary to-secondary text-primary-content py-12 px-4 mb-8 shadow-inner">
        <div class="hero-content text-center">
            <div class="max-w-2xl">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">Bienvenue chez Librairie Papeterie Marame ! 👋</h1>
                <p class="py-2 text-base md:text-lg opacity-95">
                    Votre boutique en ligne de proximité pour toute la fourniture scolaire. Commandez facilement vos cahiers, stylos et accessoires, et validez votre panier directement en un clic sur WhatsApp !
                </p>
                <div class="mt-4">
                    <span class="badge badge-lg badge-outline text-white border-white">✨ Qualité & Meilleurs Prix</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Contenu principal : Grille des produits -->
    <div class="container mx-auto px-4 mb-12">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Nos Articles Disponibles</h2>
            <div class="w-24 h-1 bg-primary mx-auto mt-2 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($produits as$produit): ?>
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all duration-300 border border-base-300 flex flex-col justify-between">
                    <!-- Zone image harmonisée (hauteur fixe et fond propre) -->
                    <figure class="h-48 w-full bg-neutral-50 overflow-hidden p-2 flex items-center justify-center border-b border-base-200">
                        <img src="<?= htmlspecialchars($produit['image']) ?>"
                             alt="<?= htmlspecialchars($produit['nom']) ?>"
                             class="max-h-full max-w-full object-contain hover:scale-105 transition-transform duration-300" />
                    </figure>
                    <div class="card-body p-5 flex flex-col justify-between flex-grow">
                        <div>
                            <span class="badge badge-primary badge-outline text-xs mb-2"><?= htmlspecialchars($produit['categorie']) ?></span>
                            <h3 class="card-title text-base font-bold text-gray-900"><?= htmlspecialchars($produit['nom']) ?></h3>
                            <p class="text-sm text-gray-600 mt-1 line-clamp-2"><?= htmlspecialchars($produit['description']) ?></p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-base-200">
                            <div class="text-lg font-extrabold text-primary mb-3"><?= number_format($produit['prix'], 0, ',', ' ') ?> FCFA</div>
                            <div class="card-actions justify-end">
                                <button class="btn btn-primary btn-sm w-full add-to-cart text-white font-semibold shadow-sm"
                                        data-id="<?= $produit['id'] ?>"
                                        data-nom="<?= htmlspecialchars($produit['nom']) ?>"
                                        data-prix="<?= $produit['prix'] ?>">
                                    🛒 Ajouter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section Panier & Validation WhatsApp -->
    <div id="cart-section" class="container mx-auto px-4 max-w-xl mb-16">
        <div class="card bg-base-100 shadow-2xl border border-primary/20 p-6 rounded-2xl">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-2xl">🛍️</span>
                <h3 class="font-bold text-xl text-gray-800">Finaliser votre commande</h3>
            </div>
            <p class="text-sm text-gray-500 mb-6">
                Vérifiez vos articles choisis et cliquez ci-dessous pour envoyer votre liste directement à notre service commercial sur WhatsApp.
            </p>
            <button onclick="checkoutWhatsApp()" class="btn btn-success w-full text-white font-bold text-base gap-2 shadow-lg hover:bg-success-focus">
                📲 Commander sur WhatsApp
            </button>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="footer footer-center p-6 bg-base-300 text-base-content text-sm">
        <div>
            <p class="font-semibold">Librairie Papeterie Marame - Tous droits réservés.</p>
            <p class="text-xs text-gray-500">Votre partenaire pour une rentrée réussie.</p>
        </div>
    </footer>

    <!-- Script JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let cart = [];
            const cartCountBadge = document.getElementById('cart-count');

            document.addEventListener('click', (e) => {
                const button = e.target.closest('.add-to-cart');

                if (button) {
                    const id = button.getAttribute('data-id');
                    const nom = button.getAttribute('data-nom');
                    const prix = parseFloat(button.getAttribute('data-prix'));

                    const existingItem = cart.find(item => item.id === id);

                    if (existingItem) {
                        existingItem.quantite += 1;
                    } else {
                        cart.push({ id, nom, prix, quantite: 1 });
                    }

                    updateCartCount();
                }
            });

            function updateCartCount() {
                const totalItems = cart.reduce((sum, item) => sum + item.quantite, 0);
                if (cartCountBadge) {
                    cartCountBadge.textContent = totalItems;
                }
            }

            window.checkoutWhatsApp = function() {
                if (cart.length === 0) {
                    alert("Votre panier est vide ! Veuillez ajouter au moins un article.");
                    return;
                }

                const phoneNumber = "Commande simulée avec succès ! Ceci est un projet de démonstration.";

                let message = "Bonjour Librairie Papeterie Marame, je souhaite passer commande :%0a%0a";
                let totalGeneral = 0;

                cart.forEach(item => {
                    let sousTotal = item.prix * item.quantite;
                    totalGeneral += sousTotal;
                    message += `- ${item.quantite}x ${item.nom} (${item.prix} FCFA l'unité) = ${sousTotal} FCFA%0a`;
                });

                message += `%0a*Total général : ${totalGeneral} FCFA*%0a`;
                message += `%0aMon adresse de livraison : [À compléter]`;

                const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
                window.open(whatsappUrl, '_blank');
            };
        });
    </script>
</body>
</html>
