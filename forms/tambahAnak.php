<?php
include("koneksi.php");

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
    $selectedOption = $_POST['nama-orangtua']; // Sesuaikan dengan nama elemen formulir yang sesuai

    list($nikIbu, $namaIbu, $namaAyah) = explode('|', $selectedOption);

    // Query SQL untuk mencari ID ibu berdasarkan nama ibu yang dipilih
    $query = "SELECT nik_ibu FROM tbl_orangtua WHERE nama_ibu = '$namaIbu' AND nama_ayah = '$namaAyah'";

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
            alert('Nama ibu dan/atau nama ayah tidak ditemukan dalam database.');
            location.replace('anak.php');
            </script>";
    }

    $koneksi->close();
} else {
    echo "<script type='text/javascript'>
        alert('Data tidak lengkap. Harap isi semua field.');
        location.replace('anak.php');
        </script>";
}
?>
