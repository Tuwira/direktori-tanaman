<?php
include 'koneksi.php';

$id = $_GET['id'];
$query = "DELETE FROM tanaman WHERE id = $id";
if (mysqli_query($conn, $query)) {
    header("Location: admin.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
