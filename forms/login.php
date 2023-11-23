<?php
include("koneksi.php");

if (isset($_POST["submit"])) {
    $nama_kader = $_POST["nama_kader"];
    $password = $_POST["kata_sandi"];

    // Query untuk memeriksa user di database
    $query = "SELECT * FROM tbl_kader WHERE nama_kader = '$nama_kader';";
    $result = $koneksi->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password_db = $row['kata_sandi'];

        // Verifying the entered password with the hashed password stored in the database
        if (password_verify($password, $hashed_password_db)) {
            // Password verification successful, proceed with login
            $id = $row['id_kader'];
            session_start();
            $_SESSION['id_kader'] = $id;
            
            header("Location: dashboard.php");
            exit();
        } else {
            // Password verification failed, display error message
            echo "<script type='text/javascript'>
            alert('Login gagal. Periksa kembali Nama Kader dan Password Anda.');
            location.replace('login1.php');
            </script>";
        }
    } else {
        // User not found, display error message
        echo "<script type='text/javascript'>
        alert('Login gagal. Periksa kembali Nama Kader dan Password Anda.');
        location.replace('login1.php');
        </script>";
    }
}

// Tutup koneksi database
$koneksi->close();
?>
