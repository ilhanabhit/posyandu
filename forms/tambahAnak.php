<?php
include("koneksi.php");
// Ambil data dari form
$nikAnak = $_POST['nik'];
$namaAnak = $_POST['nama'];
$tanggalLahir = $_POST['tanggal-lahir'];
$jenisKelamin = $_POST['jenis-kelamin'];
$beratBadanLahir = $_POST['bb-lahir'];
$tinggiBadanLahir = $_POST['tb-lahir'];
$alamat = $_POST['alamat'];
$namaIbu = $_POST['nama-ibu']; // Ambil nama ibu yang dipilih oleh pengguna dari input field

// Query SQL untuk mencari ID ibu berdasarkan nama ibu yang dipilih
$query = "SELECT nik_ibu FROM tbl_orangtua WHERE nama_ibu = '$namaIbu'";

$result = $koneksi->query($query);

if ($result->num_rows > 0) {
    // Jika ditemukan hasil, ambil ID ibu
    $row = $result->fetch_assoc();
    $idIbu = $row['nik_ibu'];

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
        alert('Nama ibu tidak ditemukan dalam database.');
        location.replace('anak.php');
        </script>";
}

$koneksi->close();
?>
