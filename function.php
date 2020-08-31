<?php

function traiter_input($donnee){
    $donnee = trim($donnee); // eliminer les espaces tab new line
    $donnee = stripcslashes($donnee); // eliminer les \
    $donnee = htmlspecialchars($donnee); // cenvertir anything else
    return $donnee;

}


//INTErtionnese
function InsertIntodata($value){
    include './BDD.PHP';
     $conn_db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd);
     $conn_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
     $conn_db->exec($value);
     $conn_db = NULL;
}



//recupere valeur fla data 
function GetfromDB($sql){
   include './BDD.PHP';
    $connction = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd);
    $connction->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $result=$connction->query($sql);
    $data= $result->fetch();
    return  $data;
}
?>