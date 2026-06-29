<?php
require '../config/database.php';
$paiements = [];
$sql = 'SELECT p.*, f.date_facture FROM paiement p JOIN facture f ON p.id_facture = f.id_facture ORDER BY p.id_paiement DESC';
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $paiements[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des paiements</title>
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
        <h1>Liste des paiements</h1>
        <div class="form-actions">
            <a class="button" href="ajouter.php">Ajouter un paiement</a>
        </div>
        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date paiement</th>
                        <th>Montant</th>
                        <th>Type</th>
                        <th>Facture</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($paiements)): ?>
                        <tr><td colspan="6">Aucun paiement enregistré.</td></tr>
                    <?php else: ?>
                        <?php foreach ($paiements as $paiement): ?>
                            <tr>
                                <td><?php echo $paiement['id_paiement']; ?></td>
                                <td><?php echo htmlspecialchars($paiement['date_paiement']); ?></td>
                                <td><?php echo number_format($paiement['montant'], 2, ',', ' '); ?> €</td>
                                <td><?php echo htmlspecialchars($paiement['type_paiement']); ?></td>
                                <td><?php echo 'Facture #' . $paiement['id_facture']; ?></td>
                                <td>
                                    <a class="button-secondary" href="supprimer.php?id=<?php echo $paiement['id_paiement']; ?>">Supprimer</a>
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
