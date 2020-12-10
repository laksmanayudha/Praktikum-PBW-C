<?php 

// inisialisasi
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_coba_crud";

// koneksi ke db
$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()){
    echo "<h1>Koneksi database gagal : " . mysqli_connect_error() . "</h1>";
    exit();
}

?>