<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Pemeriksaan isset pada setiap elemen POST
if (isset($_POST['nik'], $_POST['nama'], $_POST['tanggal-lahir'], $_POST['jenis-kelamin'], $_POST['bb-lahir'], $_POST['tb-lahir'], $_POST['alamat'], $_POST['nama-orangtua'])) {
    // Ambil data dari form
    $nikAnak = $_POST['nik'];
    $namaAnak = $_POST['nama'];
    $tanggalLahir = $_POST['tanggal-lahir'];
    $jenisKelamin = $_POST['jenis-kelamin'];
    $beratBadanLahir = $_POST['bb-lahir'];
    $tinggiBadanLahir = $_POST['tb-lahir'];
    $alamat = $_POST['alamat'];
    $idIbu = $_POST['nama-orangtua'];

        // Sekarang, Anda memiliki ID ibu yang sesuai yang dapat ditambahkan ke tabel anak
        $sql = "INSERT INTO tbl_anak (id_anak, nama_anak, tanggal_lahir_anak, jenis_kelamin, bb_lahir, tb_lahir, alamat, nik_ibu)
            VALUES ('$nikAnak', '$namaAnak', '$tanggalLahir', '$jenisKelamin', '$beratBadanLahir', '$tinggiBadanLahir', '$alamat', '$idIbu')";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
            alert('Data Berhasil Ditambah!');
            location.replace('anak.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('". $sql . "<br>" . $koneksi->error."'); </script>";
        }
    } else {
        echo "<script type='text/javascript'>
            alert('Data tidak lengkap. Harap isi semua field.');
            location.replace('anak.php');
            </script>";
    }
}
    $koneksi->close();
?>