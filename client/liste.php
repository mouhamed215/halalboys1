<?php
require '../config/database.php';
$clients = [];
$result = mysqli_query($conn, 'SELECT * FROM client ORDER BY id_client DESC');
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-container">
            <a class="brand" href="../index.php">Gestion Commerciale</a>
            <nav>
                <a href="../index.php">Home</a>
                <a href="liste.php">Client</a>
                <a href="../produit/liste.php">Produit</a>
                <a href="../commande/liste.php">Commande</a>
                <a href="../livreur/liste.php">Livreur</a>
                <a href="../facture/liste.php">Facture</a>
                <a href="../paiement/liste.php">Paiement</a>
            </nav>
        </div>
    </header>
    <main class="container page-card">
        <h1>Liste des clients</h1>
        <div class="form-actions">
            <a class="button" href="ajouter.php">Ajouter un client</a>
        </div>
        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($clients)): ?>
                        <tr><td colspan="6">Aucun client enregistré.</td></tr>
                    <?php else: ?>
                        <?php foreach ($clients as $client): ?>
                            <tr>
                                <td><?php echo $client['id_client']; ?></td>
                                <td><?php echo htmlspecialchars($client['nom']); ?></td>
                                <td><?php echo htmlspecialchars($client['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($client['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($client['adresse']); ?></td>
                                <td>
                                    <a class="button-secondary" href="modifier.php?id=<?php echo $client['id_client']; ?>">Modifier</a>
                                    <a class="button-secondary" href="supprimer.php?id=<?php echo $client['id_client']; ?>">Supprimer</a>
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
