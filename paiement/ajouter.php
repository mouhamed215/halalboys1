<?php
require '../config/database.php';
$message = '';
factures = [];
$types = ['Espèces', 'Carte bancaire', 'Mobile Money', 'Virement'];

$result = mysqli_query($conn, 'SELECT id_facture, date_facture, montant FROM facture ORDER BY id_facture DESC');
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $factures[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_paiement = sanitize($_POST['date_paiement']);
    $montant = floatval($_POST['montant']);
    $type_paiement = sanitize($_POST['type_paiement']);
    $id_facture = intval($_POST['id_facture']);

    if ($date_paiement && $montant >= 0 && $type_paiement && $id_facture > 0) {
        $sql = "INSERT INTO paiement (date_paiement, montant, type_paiement, id_facture) VALUES ('$date_paiement', '$montant', '$type_paiement', '$id_facture')";
        if (mysqli_query($conn, $sql)) {
            $message = 'Le paiement a été ajouté avec succès.';
        } else {
            $message = 'Erreur lors de l’ajout du paiement : ' . mysqli_error($conn);
        }
    } else {
        $message = 'Veuillez remplir tous les champs du paiement.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un paiement</title>
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
                <a href="../livreur/liste.php">Livreur</a>
                <a href="../facture/liste.php">Facture</a>
                <a href="liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container page-card">
        <h1>Ajouter un paiement</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="ajouter.php">
                <div class="form-group">
                    <label for="date_paiement">Date de paiement</label>
                    <input type="date" id="date_paiement" name="date_paiement" required>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="number" step="0.01" id="montant" name="montant" required>
                </div>
                <div class="form-group">
                    <label for="type_paiement">Type de paiement</label>
                    <select id="type_paiement" name="type_paiement" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($types as $type): ?>
                            <option value="<?php echo $type; ?>"><?php echo $type; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_facture">Facture associée</label>
                    <select id="id_facture" name="id_facture" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($factures as $facture): ?>
                            <option value="<?php echo $facture['id_facture']; ?>"><?php echo 'Facture #' . $facture['id_facture'] . ' - ' . htmlspecialchars($facture['date_facture']); ?></option>
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
