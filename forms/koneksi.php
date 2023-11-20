<?php

$host = "localhost";
$username = "root";
$passsword = "";
$database = "posyandu12";

$koneksi = new mysqli($host, $username, $passsword, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal : " . $koneksi->connect_error);
}
?>