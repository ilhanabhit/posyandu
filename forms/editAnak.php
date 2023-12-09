<?php
include("koneksi.php");

if(isset($_POST['update'])){
    $nikBalita = $_POST['nik'];
    $namaBalita = $_POST['nama'];
    $jenisKelamin = $_POST['jenis-kelamin'];
    $tanggalLahir = $_POST['tanggal-lahir'];
    $beratBadan = $_POST['bb-lahir'];
    $tinggiBadan = $_POST['tb-lahir'];
    $alamat = $_POST['alamat'];

        // Update child data in the database, including the id_ibu
        $sql = "UPDATE tbl_anak SET 
                nama_anak = '$namaBalita',
                jenis_kelamin = '$jenisKelamin',
                tanggal_lahir_anak = '$tanggalLahir',
                bb_lahir = '$beratBadan',
                tb_lahir = '$tinggiBadan',
                alamat = '$alamat',
                WHERE id_anak = '$nikBalita'";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
        alert('Data Berhasil Diedit!');
        location.replace('anak.php');
        </script>";
        } else {
            echo "<script type='text/javascript'>
        alert('". $sql . "<br>" . $koneksi->error."'); </script>";
        }

    $koneksi->close();
}
?>