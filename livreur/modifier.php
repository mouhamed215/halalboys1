<?php
require '../config/database.php';
$message = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$livreur = null;

if ($id > 0) {
    $result = mysqli_query($conn, "SELECT * FROM livreur WHERE id_livreur = $id");
    if ($result) {
        $livreur = mysqli_fetch_assoc($result);
    }
}

if (!$livreur) {
    header('Location: liste.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = sanitize($_POST['nom']);
    $prenom = sanitize($_POST['prenom']);
    $telephone = sanitize($_POST['telephone']);
    $matricule_moto = sanitize($_POST['matricule_moto']);

    if ($nom && $prenom && $telephone && $matricule_moto) {
        $sql = "UPDATE livreur SET nom = '$nom', prenom = '$prenom', telephone = '$telephone', matricule_moto = '$matricule_moto' WHERE id_livreur = $id";
        if (mysqli_query($conn, $sql)) {
            header('Location: liste.php?updated=1');
            exit;
        } else {
            $message = 'Erreur lors de la modification : ' . mysqli_error($conn);
        }
    } else {
        $message = 'Veuillez remplir tous les champs.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un livreur</title>
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
        <h1>Modifier le livreur</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="modifier.php?id=<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($livreur['nom']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($livreur['prenom']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($livreur['telephone']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="matricule_moto">Matricule Moto</label>
                    <input type="text" id="matricule_moto" name="matricule_moto" value="<?php echo htmlspecialchars($livreur['matricule_moto']); ?>" required>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit">Mettre à jour</button>
                    <a class="button-secondary" href="liste.php">Retour à la liste</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
