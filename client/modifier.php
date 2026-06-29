<?php
require '../config/database.php';
$message = '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$client = null;

if ($id > 0) {
    $result = mysqli_query($conn, "SELECT * FROM client WHERE id_client = $id");
    if ($result) {
        $client = mysqli_fetch_assoc($result);
    }
}

if (!$client) {
    header('Location: liste.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = sanitize($_POST['nom']);
    $prenom = sanitize($_POST['prenom']);
    $telephone = sanitize($_POST['telephone']);
    $adresse = sanitize($_POST['adresse']);

    if ($nom && $prenom && $telephone && $adresse) {
        $sql = "UPDATE client SET nom = '$nom', prenom = '$prenom', telephone = '$telephone', adresse = '$adresse' WHERE id_client = $id";
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
    <title>Modifier un client</title>
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
        <h1>Modifier le client</h1>
        <?php if ($message): ?>
            <div class="alert"><?php echo $message; ?></div>
        <?php endif; ?>
        <section class="form-card">
            <form method="post" action="modifier.php?id=<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($client['nom']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($client['prenom']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" id="telephone" name="telephone" value="<?php echo htmlspecialchars($client['telephone']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <textarea id="adresse" name="adresse" required><?php echo htmlspecialchars($client['adresse']); ?></textarea>
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
