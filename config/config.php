<?php

    session_start();

    $host = "localhost";
    $dbname = "primexTech";
    $username = "root";
    $password = "1234";

    try{

        $conn = new PDO("mysql:host=$host; dbname=$dbname;" , $username , $password);
    
    }catch(PDOException $e){

        echo $e->getMessage();

    }