<?php 
require("koneksi.php");


function isUserValid($username, $password){

    global $conn;
    $query = "SELECT * FROM users WHERE username = '$username'  AND password = '$password' ";
    $result = mysqli_query($conn, $query);

    if( mysqli_num_rows($result) > 0 ){
        return true;
    }else{
        return false;
    }
}

function getUserId($username, $password){
    global $conn;
    $query = "SELECT id FROM users WHERE username = '$username'  AND password = '$password' ";
    $result = mysqli_query($conn, $query);

    return get_data($result)[0]["id"];
}

function getUserData($id){
    global $conn;
    $query = "SELECT * FROM users WHERE id = $id ";
    $result = mysqli_query($conn, $query);

    return get_data($result)[0];
}

function get_data($result){
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function validInput($inputs){
    foreach ($inputs as $input){
        if(empty($input)){
            return false;
        }
    }
    return true;
}

function cleanInput($inputs){
    foreach ($inputs as $key => $input){
        $input = htmlspecialchars($input);
        $inputs[$key] = $input;
    }
    return $inputs;
}

function insertData($inputs){
    global $conn;
    foreach($inputs as $pos => $input) $inputs[$pos] = "'$input'";
    $data = join(", ", $inputs);
    $query = "INSERT INTO mahasiswa VALUES (''," . $data . ")";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function getAllMahasiswa(){
    global $conn;
    $query = "SELECT * FROM mahasiswa";
    $result = mysqli_query($conn, $query);

    return get_data($result);
}

function getMahasiswa($id){
    global $conn;
    $query = "SELECT * FROM mahasiswa WHERE id = " . $id;
    $result = mysqli_query($conn, $query);

    return get_data($result)[0];
}

function updateData($inputs){
    global $conn;
    $id = $inputs['id'];
    $nim = $inputs['nim'];
    $nama = $inputs['nama'];
    $alamat = $inputs['alamat'];
    $query = "UPDATE mahasiswa SET
                nim = '$nim',
                nama = '$nama',
                alamat = '$alamat'
              WHERE id = $id
            ";
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteData($id){
    global $conn;
    $query = "DELETE FROM mahasiswa WHERE id=" . $id;
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>