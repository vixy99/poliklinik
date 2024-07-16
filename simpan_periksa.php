<?php 
    include  "database.php";

if(isset( $_POST['idpasien']) && isset($_POST['id_dokter'])&& isset($_POST['tgl_periksa'])&& isset($_POST['penyakit'])) {
    $id_pasien = $_POST['idpasien'] ;
    $id_dokter = $_POST['id_dokter'] ;
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['penyakit'];

}