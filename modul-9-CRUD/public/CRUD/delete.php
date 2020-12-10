<?php 

require("functions.php");
session_start();

// cek session, kalo gak ada kembali ke login
if( !isset($_SESSION['login']) ){
    header("Location:login.php");
    exit;
}

// tangkap id
$id = $_GET['id'];
if(deleteData($id) > 0){
    echo " 
        <script> 
            alert('data berhasil dihapus'); 
            document.location.href = '../home.php';
        </script> 
    ";
}
?>