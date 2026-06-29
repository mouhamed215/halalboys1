<?php
require '../config/database.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "DELETE FROM paiement WHERE id_paiement = $id";
    mysqli_query($conn, $sql);
}
header('Location: liste.php?deleted=1');
exit;
