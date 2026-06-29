<?php
require '../config/database.php';
$message = '';
$commandes = [];

$result = mysqli_query($conn, 'SELECT id_commande, date_commande, montant FROM commande ORDER BY id_commande DESC');
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $commandes[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date_facture = sanitize($_POST['date_facture']);
    $montant = floatval($_POST['montant']);
    $id_commande = intval($_POST['id_commande']);

    if ($date_facture && $montant >= 0 && $id_commande > 0) {
        $sql = "INSERT INTO facture (date_facture, montant, id_commande) VALUES ('$date_facture', '$montant', '$id_commande')";
        if (mysqli_query($conn, $sql)) {
            $message = 'La facture a été générée avec succès.';
        } else {
            $message = 'Erreur lors de la création de la facture : ' . mysqli_error($conn);
        }
    } else {
        $message = 'Veuillez remplir tous les champs correctement.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une facture</title>
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
                <a href="liste.php">Facture</a>
                <a href="../paiement/liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container page-card">
        <h1>Ajouter une facture</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="ajouter.php">
                <div class="form-group">
                    <label for="date_facture">Date de facture</label>
                    <input type="date" id="date_facture" name="date_facture" required>
                </div>
                <div class="form-group">
                    <label for="montant">Montant</label>
                    <input type="number" step="0.01" id="montant" name="montant" required>
                </div>
                <div class="form-group">
                    <label for="id_commande">Commande associée</label>
                    <select id="id_commande" name="id_commande" required>
                        <option value="">Sélectionner</option>
                        <?php foreach ($commandes as $commande): ?>
                            <option value="<?php echo $commande['id_commande']; ?>"><?php echo 'Commande #' . $commande['id_commande'] . ' - ' . htmlspecialchars($commande['date_commande']); ?></option>
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
