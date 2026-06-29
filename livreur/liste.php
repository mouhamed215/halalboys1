<?php
require '../config/database.php';
$livreurs = [];
$result = mysqli_query($conn, 'SELECT * FROM livreur ORDER BY id_livreur DESC');
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $livreurs[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des livreurs</title>
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
        <h1>Liste des livreurs</h1>
        <div class="form-actions">
            <a class="button" href="ajouter.php">Ajouter un livreur</a>
        </div>
        <section class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Matricule</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($livreurs)): ?>
                        <tr><td colspan="6">Aucun livreur enregistré.</td></tr>
                    <?php else: ?>
                        <?php foreach ($livreurs as $livreur): ?>
                            <tr>
                                <td><?php echo $livreur['id_livreur']; ?></td>
                                <td><?php echo htmlspecialchars($livreur['nom']); ?></td>
                                <td><?php echo htmlspecialchars($livreur['prenom']); ?></td>
                                <td><?php echo htmlspecialchars($livreur['telephone']); ?></td>
                                <td><?php echo htmlspecialchars($livreur['matricule_moto']); ?></td>
                                <td>
                                    <a class="button-secondary" href="modifier.php?id=<?php echo $livreur['id_livreur']; ?>">Modifier</a>
                                    <a class="button-secondary" href="supprimer.php?id=<?php echo $livreur['id_livreur']; ?>">Supprimer</a>
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
