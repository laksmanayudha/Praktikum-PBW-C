<?php 

require_once('function.php');
session_start();


// tombol submit
if( isset($_POST['submit']) ){


    $nilai_tugas = cek_input($_POST['tugas']);
    $nilai_uts = cek_input($_POST['uts']);
    $nilai_uas = cek_input($_POST['uas']);

    $tugas_valid = valid($nilai_tugas);
    $uas_valid = valid($nilai_uas);
    $uts_valid = valid($nilai_uts);

    // hitung jika sudah valid
    if( $tugas_valid && $uas_valid && $uts_valid ){

        $hasil = ($nilai_tugas + $nilai_uas + $nilai_uts)/3;

        if ( $hasil >= 80 ){
            $kalimat = "Selamat anda lulus dengan predikat A";
            $predikat = "A";
        }else if( $hasil >= 70 ){
            $kalimat = "Selamat anda lulus dengan predikat B";
            $predikat = "B";
        }else if( $hasil >= 60 ){
            $kalimat = "Selamat anda lulus dengan predikat C";
            $predikat = "C";
        }else{
            $kalimat = "Selamat anda tidak lulus";
            $predikat = "Tidak lulus";
        }

        $_SESSION['list_nilai'][] = [
            "tugas" => $nilai_tugas,
            "uts" => $nilai_uts,
            "uas" => $nilai_uas,
            "hasil" => $hasil,
            "predikat" => $predikat
        ];

    }else{
        echo "<p style='color:red'>Silahkan isi nilai dengan benar </p>";
    }

    
}

// tombol delete
if( isset($_POST['delete']) ){
    $_SESSION['list_nilai'] = [];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>

<div class="container">

    <form action="index.php" method="POST">

        <label for="tugas">Nilai Tugas : </label>
        <input type="text" id="tugas" name="tugas"><br><br>

        <label for="uts">Nilai UTS : </label>
        <input type="text" id="uts" name="uts"><br><br>


        <label for="uasd">Nilai UAS : </label>
        <input type="text" id="uasd" name="uas"><br><br>

        <h4>Nilai akhir anda : </h4> 
        <?php if( isset($hasil) ) : echo $hasil?>
            <h5><?php echo $kalimat ?></h5>
        <?php endif; ?>

        <button name="submit">cek</button>
        <button name="delete">delete</button>
    </form>

    <?php if( isset($_SESSION['list_nilai']) ) :  ?>

        <table border="1" cellpadding="10">

            <tr>
                <td>No.</td>
                <td>Tugas</td>
                <td>UTS</td>
                <td>UAS</td>
                <td>Hasil</td>
                <td>Predikat</td>
            </tr>
            <?php foreach( $_SESSION['list_nilai'] as $pos => $nilai ) : ?>
                <tr>
                    <td><?php echo $pos + 1; ?></td>
                    <td><?php echo $nilai['tugas'] ?></td>
                    <td><?php echo $nilai['uts'] ?></td>
                    <td><?php echo $nilai['uas'] ?></td>
                    <td><?php echo $nilai['hasil'] ?></td>
                    <td><?php echo $nilai['predikat'] ?></td>
                </tr>
            <?php endforeach; ?>
        
        </table>

    <?php endif; ?>

</div>
    
</body>
</html>