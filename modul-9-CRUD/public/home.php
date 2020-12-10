<?php 

require("./CRUD/functions.php");
session_start();

// cek session, kalo gak ada kembali ke login
if( !isset($_SESSION['login']) ){
    header("Location:login.php");
    exit;
}

// ambil data user
$userid = $_SESSION['auth_user'];
$user = getUserData($userid);

// ambil data mahasiswa
$mahasiswa = getAllMahasiswa();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <h1>Halo, <?php echo $user['role'] . " " . $user["username"]; ?> Selamat Datang !</h1>
    <div class="container">
        <div class="tambah"><a href="./CRUD/create.php" class="mybtn green">tambah data</a></div>

        <?php if( count($mahasiswa) > 0 )  : ?>
            <table border="1" cellpadding="10">
                <tr>
                    <th>no.</th>
                    <?php foreach(array_keys($mahasiswa[0]) as $key) : ?>
                        <?php if($key != 'id') :  ?>
                            <th><?php echo $key; ?></th>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <th>aksi</th>
                </tr>
                
                <!-- data -->
                <?php $nomor = 1; ?>
                <?php foreach($mahasiswa as $m) : ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $m['nim']; ?></td>
                        <td><?php echo $m['nama']; ?></td>
                        <td><?php echo $m['alamat']; ?></td>
                        <td>
                            <a href="./CRUD/edit.php?id=<?php echo $m['id']; ?>" class=" blue mybtn ">edit</a>
                            <?php if($user['role'] == 'admin') : ?>
                               | <a href="./CRUD/delete.php?id=<?php echo $m['id']; ?>" class=" red mybtn "> hapus</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    
        <div class="logout"><a href="logout.php" class="mybtn green">Logout</a></div>
    </div>

    
</body>
</html>