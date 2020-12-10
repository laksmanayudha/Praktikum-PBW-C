<?php 
require("./CRUD/functions.php");

// cek tombol login
if( isset($_POST['login']) ){

    // ambil username dan password
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // cek username dan password di database
    if( isUserValid($username, $password) ){

        // ambil id user
        $id = getuserId($username, $password);
        
        //session mulai, pindahkan ke home.php
        session_start();
        $_SESSION['login'] = true;
        $_SESSION['auth_user'] = $id;
        header("Location:home.php");
        exit;
    }
    
    // login error
    $login = [
        "error" => true,
        "err_message" => "passoword atau username salah"
    ];
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>


    <div class="container">

        <!-- login error -->
        <?php if( isset($login['error']) ) :  ?>
            <p style="color:red" ><?php echo $login['err_message'] ?></p>
        <?php endif; ?>


        <h2>login</h2>

        <form action="./login.php" method="POST">
        
            <label for="username">Username : </label><br>
            <input type="text" id="username" name="username" required><br><br>
            <label for="pass">Passowrd : </label><br>
            <input type="password" id="pass" name="pass" required><br><br>

            <button name="login">Login</button>
        </form>
    
    </div>


    
</body>
</html>