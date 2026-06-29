<?php
require '../config/database.php';
$commandes = [];
$sql = 'SELECT c.*, cl.nom AS nom_client, cl.prenom AS prenom_client, l.nom AS nom_livreur, l.prenom AS prenom_livreur FROM commande c JOIN client cl ON c.id_client = cl.id_client JOIN livreur l ON c.id_livreur = l.id_livreur ORDER BY c.id_commande DESC';
$result = mysqli_query($conn, $sql);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $commandes[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des commandes</title>
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
        <h1>Liste des commandes</h1>
        <div class="form-actions">
            <a class="button" href="ajouter.php">Ajouter une commande</a>
        </div>
        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Client</th>
                        <th>Livreur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($commandes)): ?>
                        <tr><td colspan="7">Aucune commande enregistrée.</td></tr>
                    <?php else: ?>
                        <?php foreach ($commandes as $commande): ?>
                            <tr>
                                <td><?php echo $commande['id_commande']; ?></td>
                                <td><?php echo htmlspecialchars($commande['date_commande']); ?></td>
                                <td><?php echo number_format($commande['montant'], 2, ',', ' '); ?> €</td>
                                <td><span class="status status-<?php echo strtolower(str_replace(' ', '-', $commande['statut'])); ?>"><?php echo htmlspecialchars($commande['statut']); ?></span></td>
                                <td><?php echo htmlspecialchars($commande['nom_client'] . ' ' . $commande['prenom_client']); ?></td>
                                <td><?php echo htmlspecialchars($commande['nom_livreur'] . ' ' . $commande['prenom_livreur']); ?></td>
                                <td>
                                    <a class="button-secondary" href="modifier.php?id=<?php echo $commande['id_commande']; ?>">Modifier</a>
                                    <a class="button-secondary" href="supprimer.php?id=<?php echo $commande['id_commande']; ?>">Supprimer</a>
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
