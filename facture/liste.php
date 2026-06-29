<?php
require '../config/database.php';
$factures = [];
$sql = 'SELECT f.*, c.date_commande, c.montant AS montant_commande FROM facture f JOIN commande c ON f.id_commande = c.id_commande ORDER BY f.id_facture DESC';
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $factures[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des factures</title>
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
        <h1>Liste des factures</h1>
        <div class="form-actions">
            <a class="button" href="ajouter.php">Ajouter une facture</a>
        </div>
        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date facture</th>
                        <th>Montant</th>
                        <th>Commande</th>
                        <th>Montant commande</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($factures)): ?>
                        <tr><td colspan="6">Aucune facture enregistrée.</td></tr>
                    <?php else: ?>
                        <?php foreach ($factures as $facture): ?>
                            <tr>
                                <td><?php echo $facture['id_facture']; ?></td>
                                <td><?php echo htmlspecialchars($facture['date_facture']); ?></td>
                                <td><?php echo number_format($facture['montant'], 2, ',', ' '); ?> €</td>
                                <td><?php echo 'Commande #' . $facture['id_commande']; ?></td>
                                <td><?php echo number_format($facture['montant_commande'], 2, ',', ' '); ?> €</td>
                                <td>
                                    <a class="button-secondary" href="supprimer.php?id=<?php echo $facture['id_facture']; ?>">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
