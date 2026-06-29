<?php
require '../config/database.php';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
    $sql = "DELETE FROM client WHERE id_client = $id";
    mysqli_query($conn, $sql);
}
header('Location: liste.php?deleted=1');
exit;
