<?php
// Sisipkan file koneksi.php
include('koneksi.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $id_kader = $_POST['nik'];
    $nama_kader = $_POST['nama'];
    $tgl_lahir = $_POST['tanggal-lahir'];
    $alamat = $_POST['alamat'];
    $jabatan = $_POST['jabatan'];
    $tugas_pokok = $_POST['tugas-pokok'];
    $no_telp = $_POST['no_telp'];

    // Handle image upload only if a new image is selected
    if (!empty($_FILES["img_kader"]["name"])) {
        $targetDir = "berkas/team/";
        $targetFile = $targetDir . basename($_FILES["img_kader"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["img_kader"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File bukan gambar.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["img_kader"]["size"] > 5000000) {
            echo "<script>alert('Maaf, ukuran file terlalu besar.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.');</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Maaf, file tidak terunggah.');</script>";
        } else {
            if (move_uploaded_file($_FILES["img_kader"]["tmp_name"], $targetFile)) {
                $gambar = basename($_FILES["img_kader"]["name"]);
            } else {
                echo "<script>alert('Maaf, terjadi kesalahan saat mengunggah gambar.');</script>";
            }
        }
    }

    // Siapkan pernyataan SQL untuk memperbarui data di dalam tabel
    $sql = "UPDATE tbl_kader
            SET nama_kader = '$nama_kader', 
                tgl_lahir = '$tgl_lahir', 
                alamat = '$alamat', 
                jabatan = '$jabatan', 
                tugas_pokok = '$tugas_pokok',
                no_telp = '$no_telp'";
    
    // Add image update to SQL statement if a new image is uploaded
    if (isset($gambar)) {
        $sql .= ", img_kader = '$gambar'";
    }

    $sql .= " WHERE id_kader = '$id_kader'";

    // Eksekusi pernyataan SQL
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data Kader Berhasil Diperbarui!');</script>";
        echo '<script>window.location.href = "kader.php";</script>';
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $koneksi->error . "');</script>";
    }
}

// Tutup koneksi basis data
$koneksi->close();
?>