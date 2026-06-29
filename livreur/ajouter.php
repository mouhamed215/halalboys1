<?php
require '../config/database.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = sanitize($_POST['nom']);
    $prenom = sanitize($_POST['prenom']);
    $telephone = sanitize($_POST['telephone']);
    $matricule_moto = sanitize($_POST['matricule_moto']);

    if ($nom && $prenom && $telephone && $matricule_moto) {
        $sql = "INSERT INTO livreur (nom, prenom, telephone, matricule_moto) VALUES ('$nom', '$prenom', '$telephone', '$matricule_moto')";
        if (mysqli_query($conn, $sql)) {
            $message = 'Le livreur a été ajouté avec succès.';
        } else {
            $message = 'Erreur lors de l’ajout du livreur : ' . mysqli_error($conn);
        }
    } else {
        $message = 'Veuillez remplir tous les champs du formulaire.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un livreur</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-container">
            <a class="brand" href="../index.php">Gestion Commerciale</a>
            <nav>
                <a href="../index.php">Home</a>
                <a href="../client/liste.php">Client</a>
                <a href="../produit/liste.php">Produit</a>
                <a href="../commande/liste.php">Commande</a>
                <a href="liste.php">Livreur</a>
                <a href="../facture/liste.php">Facture</a>
                <a href="../paiement/liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container page-card">
        <h1>Ajouter un livreur</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="ajouter.php">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" id="telephone" name="telephone" required>
                </div>
                <div class="form-group">
                    <label for="matricule_moto">Matricule Moto</label>
                    <input type="text" id="matricule_moto" name="matricule_moto" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit">Enregistrer</button>
                    <a class="button-secondary" href="liste.php">Retour à la liste</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
