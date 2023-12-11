<?php
include("koneksi.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pemeriksaan isset pada setiap elemen POST
    if (isset($_POST['nik'], $_POST['nama'], $_POST['tanggal-lahir'], $_POST['jenis-kelamin'], $_POST['bb-lahir'], $_POST['tb-lahir'])) {
        // Ambil data dari form
        $nikAnak = $_POST['nik'];
        $namaAnak = $_POST['nama'];
        $tanggalLahir = $_POST['tanggal-lahir'];
        $jenisKelamin = $_POST['jenis-kelamin'];
        $beratBadanLahir = $_POST['bb-lahir'];
        $tinggiBadanLahir = $_POST['tb-lahir'];
        $alamat = $_POST['alamat'];

        // Sekarang, Anda memiliki ID ibu yang sesuai yang dapat ditambahkan ke tabel anak
        $sql = "UPDATE tbl_anak SET
            nama_anak = '$namaAnak',
            tanggal_lahir_anak = '$tanggalLahir',
            jenis_kelamin = '$jenisKelamin',
            bb_lahir = '$beratBadanLahir',
            tb_lahir = '$tinggiBadanLahir',
            alamat = '$alamat'
            WHERE id_anak = '$nikAnak'";

        if ($koneksi->query($sql) === TRUE) {
            echo "<script type='text/javascript'>
            alert('Data Berhasil Diupdate!');
            location.replace('anak.php');
            </script>";
        } else {
            echo "<script type='text/javascript'>
            alert('Error updating record: " . $koneksi->error . "');
            </script>";
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
