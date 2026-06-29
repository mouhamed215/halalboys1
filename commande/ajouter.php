<?php
require '../config/database.php';
$message = '';
$clients = [];
$livreurs = [];
$statuts = ['En cours', 'Livrée', 'Annulée'];

$resultClient = mysqli_query($conn, 'SELECT id_client, nom, prenom FROM client ORDER BY nom');
if ($resultClient) {
    while ($row = mysqli_fetch_assoc($resultClient)) {
        $clients[] = $row;
    }
}

$resultLivreur = mysqli_query($conn, 'SELECT id_livreur, nom, prenom FROM livreur ORDER BY nom');
if ($resultLivreur) {
    while ($row = mysqli_fetch_assoc($resultLivreur)) {
        $livreurs[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_commande = sanitize($_POST['date_commande']);
    $montant = floatval($_POST['montant']);
    $statut = sanitize($_POST['statut']);
    $id_client = intval($_POST['id_client']);
    $id_livreur = intval($_POST['id_livreur']);

    if ($date_commande && $montant >= 0 && $statut && $id_client > 0 && $id_livreur > 0) {
        $sql = "INSERT INTO commande (date_commande, montant, statut, id_client, id_livreur) VALUES ('$date_commande', '$montant', '$statut', '$id_client', '$id_livreur')";
        if (mysqli_query($conn, $sql)) {
            $message = 'La commande a été enregistrée avec succès.';
        } else {
            $message = 'Erreur lors de l’ajout de la commande : ' . mysqli_error($conn);
        }
    } else {
        $message = 'Veuillez remplir tous les champs de la commande.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une commande</title>
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
                <a href="liste.php">Commande</a>
                <a href="../livreur/liste.php">Livreur</a>
                <a href="../facture/liste.php">Facture</a>
                <a href="../paiement/liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container page-card">
        <h1>Ajouter une commande</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="ajouter.php">
                <div class="form-group">
                    <label for="date_commande">Date de commande</label>
                    <input type="date" id="date_commande" name="date_commande" required>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="number" step="0.01" id="montant" name="montant" required>
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($statuts as $option): ?>
                            <option value="<?php echo $option; ?>"><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_client">Client</label>
                    <select id="id_client" name="id_client" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?php echo $client['id_client']; ?>"><?php echo htmlspecialchars($client['nom'] . ' ' . $client['prenom']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_livreur">Livreur</label>
                    <select id="id_livreur" name="id_livreur" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($livreurs as $livreur): ?>
                            <option value="<?php echo $livreur['id_livreur']; ?>"><?php echo htmlspecialchars($livreur['nom'] . ' ' . $livreur['prenom']); ?></option>
                        <?php endforeach; ?>
                    </select>
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
