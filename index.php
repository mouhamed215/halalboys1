<?php
// Page d'accueil de l'application de gestion commerciale
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commerciale</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-container">
            <a class="brand" href="index.php">Gestion Commerciale</a>
            <nav>
                <a href="index.php">Home</a>
                <a href="client/liste.php">Client</a>
                <a href="produit/liste.php">Produit</a>
                <a href="commande/liste.php">Commande</a>
                <a href="livreur/liste.php">Livreur</a>
                <a href="facture/liste.php">Facture</a>
                <a href="paiement/liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container main-card">
        <section class="hero">
            <h1>Application de gestion commerciale</h1>
            <p>Gérez facilement vos clients, produits, commandes, livreurs, factures et paiements avec une interface professionnelle prête pour XAMPP/WAMP.</p>
            <div class="home-links">
                <a class="button" href="client/ajouter.php">Ajouter un client</a>
                <a class="button" href="produit/ajouter.php">Ajouter un produit</a>
                <a class="button" href="commande/ajouter.php">Créer une commande</a>
                <a class="button" href="facture/ajouter.php">Créer une facture</a>
            </div>
        </section>
    </main>
</body>
</html>
