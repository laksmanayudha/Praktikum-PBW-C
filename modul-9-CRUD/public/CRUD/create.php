<?php 
require("functions.php");
session_start();

// cek session, kalo gak ada kembali ke login
if( !isset($_SESSION['login']) ){
    header("Location:login.php");
    exit;
}

// tombol tambah
if( isset($_POST['tambah']) ){

    // validasi input
    $inputs = [
       "nim" => $_POST['nim'], 
       "nama" => $_POST['nama'], 
       "alamat" => $_POST['alamat']
    ];
    if( validInput($inputs) ){

        $clean_inputs = cleanInput($inputs);

        //insert data
        if(insertData($clean_inputs) > 0){
            echo " 
                <script> 
                    alert('data berhasil ditambahkan'); 
                    document.location.href = '../home.php';
                </script> 
            ";
        }

    }
    $data = [
        "error" => true,
        "err_message" => "terjadi kesalahan pada input"
    ];

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">

        <?php if( isset($data['error']) ) : ?>
            <p style="color:red" ><?php echo $data['err_message'] ?></p>
        <?php endif; ?>

        <h2>Tambah Data Mahasiswa : </h2>
        <form action="" method="POST">
        
            <label for="nim">NIM : </label>
            <input type="text" name="nim" id="nim" required><br><br>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" required><br><br>
            <label for="alamat">Alamat : </label>
            <input type="text" name="alamat" id="alamat"><br><br>
            
            <button name="tambah" class="mybtn green">Tambah</button>
        </form>
        
        <br>
        <a href="../home.php"  class="mybtn blue">kembali</a>
    
    </div>
    
</body>
</html>
