<?php 

function cek_input($nilai){
    return ($nilai != "" && is_numeric($nilai)) ? $nilai : 0;
}

function valid($nilai){
    return $nilai <= 100 && $nilai >= 0;
}