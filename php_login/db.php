<?php
    $server='localhost';
    $username='root';
    $password='';
    $db='php_login';

    try{
        $conn= new PDO("mysql:host=$server;dbname=$db;",$username,$password);
    }catch(PDOException $e){
        die('Connected failed'.$e->getMessage());
    }
?>