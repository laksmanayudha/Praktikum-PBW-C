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
$mahasiswa = getMahasiswa($id);

// tombol ubah
if( isset($_POST['ubah']) ){

    // validasi input
    $inputs = [
        "id" => $_POST['id'],
       "nim" => $_POST['nim'], 
       "nama" => $_POST['nama'], 
       "alamat" => $_POST['alamat']
    ];
    if( validInput($inputs) ){

        $clean_inputs = cleanInput($inputs);

        //insert data
        if(updateData($clean_inputs) > 0){
            echo " 
                <script> 
                    alert('data berhasil diubah'); 
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
    <title>Ubah Mahasiswa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <div class="container">

        <?php if( isset($data['error']) ) : ?>
            <p style="color:red" ><?php echo $data['err_message'] ?></p>
        <?php endif; ?>

        <h2>Ubah Data Mahasiswa : </h2>
        <form action="" method="POST">

            <!-- id -->
            <input type="hidden" name="id" value="<?php echo $mahasiswa['id']; ?>">
        
            <label for="nim">NIM : </label>
            <input type="text" name="nim" id="nim" value="<?php echo $mahasiswa['nim']; ?>" required><br><br>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama" value="<?php echo $mahasiswa['nama']; ?>" required><br><br>
            <label for="alamat">Alamat : </label>
            <input type="text" name="alamat" id="alamat" value="<?php echo $mahasiswa['alamat']; ?>" ><br><br>
            
            <button name="ubah"class="mybtn green" >Ubah</button>
        </form>
        
        <br>
        <a href="../home.php" class="mybtn blue">kembali</a>
    
    </div>
    
</body>
</html>
