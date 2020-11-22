<?php 

require('function.php');

if( isset($_POST['submit']) ){


    $nilai_tugas = cek_input($_POST['tugas']);
    $nilai_uts = cek_input($_POST['uts']);
    $nilai_uas = cek_input($_POST['uas']);

    $tugas_valid = valid($nilai_tugas);
    $uas_valid = valid($nilai_uas);
    $uts_valid = valid($nilai_uts);

    if( $tugas_valid && $uas_valid && $uts_valid ){

        $hasil = ($nilai_tugas + $nilai_uas + $nilai_uts)/3;

        if ( $hasil >= 80 ){
            $kalimat = "Selamat anda lulus dengan predikat A";
        }else if( $hasil >= 70 ){
            $kalimat = "Selamat anda lulus dengan predikat B";
        }else if( $hasil >= 60 ){
            $kalimat = "Selamat anda lulus dengan predikat C";
        }else{
            $kalimat = "Selamat anda tidak lulus";
        }

    }else{
        echo "<p style='color:red'>Silahkan isi nilai dengan benar </p>";
    }

    
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
    </form>

</div>
    
</body>
</html>