<?php
include "header.php";
include "database.php";


$id_periksa = $_GET['id'];


$query = "SELECT * FROM periksa WHERE id_periksa = $id_periksa";
$result = mysqli_query($conn, $query);
$data_periksa = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $id_penyakit = $_POST['id_obat'];
    $id_obat = $_POST['id_obat'];
    $id_harga = $_POST['id_obat'];


    $query = "UPDATE periksa SET id_pasien='$id_pasien', id_dokter='$id_dokter', tgl_periksa='$tgl_periksa', id_penyakit='$id_penyakit', id_obat='$id_obat', id_harga='$id_harga' WHERE id_periksa=$id_periksa";
    if (mysqli_query($conn, $query)) {
        header('Location: data_periksa.php');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}


$obat_result = mysqli_query($conn, "SELECT * FROM obat");
$obat_data = [];
while ($data_obat = mysqli_fetch_assoc($obat_result)) {
    $obat_data[] = $data_obat;
}
?>

<div class="container mt-5">
    <h2>Edit Data Periksa</h2>
    <form name="periksa" action="" method="POST">
        <div class="form-group">
            <label for="inputPasien">Pasien</label>
            <select class="form-control" name="id_pasien">
                <?php
                $pasien_result = mysqli_query($conn, "SELECT * FROM pasien");
                while ($data_pasien = mysqli_fetch_array($pasien_result)) {
                    $selected = $data_pasien['id_pasien'] == $data_periksa['id_pasien'] ? 'selected' : '';
                    echo '<option value="' . $data_pasien['id_pasien'] . '" ' . $selected . '>' . $data_pasien['nama_pasien'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="inputDokter">Dokter</label>
            <select class="form-control" name="id_dokter">
                <?php
                $dokter_result = mysqli_query($conn, "SELECT * FROM dokter");
                while ($data_dokter = mysqli_fetch_array($dokter_result)) {
                    $selected = $data_dokter['id_dokter'] == $data_periksa['id_dokter'] ? 'selected' : '';
                    echo '<option value="' . $data_dokter['id_dokter'] . '" ' . $selected . '>' . $data_dokter['nama_dokter'] . '</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="tgl">Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" id="tgl" value="<?= $data_periksa['tgl_periksa'] ?>" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="inputObat">Keluhan</label>
            <select class="form-control" name="id_obat" id="inputObat" onchange="updateFields()">
                <option value="">Pilih Keluhan</option>
                <?php
                foreach ($obat_data as $data_obat) {
                    $selected = $data_obat['id_obat'] == $data_periksa['id_obat'] ? 'selected' : '';
                    echo '<option value="' . $data_obat['id_obat'] . '" data-penyakit="' . $data_obat['id_penyakit'] . '" data-harga="' . $data_obat['harga'] . '" ' . $selected . '>' . $data_obat['id_penyakit'] . '</option>';
                }
                ?>
            </select>
        </div>

        <input type="hidden" name="id_penyakit" id="inputPenyakit" value="<?= $data_periksa['id_penyakit'] ?>">
        <input type="hidden" name="id_harga" id="inputHarga" value="<?= $data_periksa['id_harga'] ?>">

        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="data_periksa.php" class="btn btn-default">Kembali</a>
    </form>
</div>

<script>
function updateFields() {
    var obatSelect = document.getElementById('inputObat');
    var selectedOption = obatSelect.options[obatSelect.selectedIndex];
    var penyakitField = document.getElementById('inputPenyakit');
    var hargaField = document.getElementById('inputHarga');

    penyakitField.value = selectedOption.getAttribute('data-penyakit');
    hargaField.value = selectedOption.getAttribute('data-harga');
}
</script>
