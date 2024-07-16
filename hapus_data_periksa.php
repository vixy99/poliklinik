<?php
include "header.php";
include "database.php";

// Mendapatkan ID periksa dari URL
$id_periksa = $_GET['id'];

// Menghapus data periksa berdasarkan ID
$query = "DELETE FROM periksa WHERE id_periksa = $id_periksa";
if (mysqli_query($conn, $query)) {
    header('Location: data_periksa.php');
    exit();
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>
