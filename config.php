<?php
try{
    $pdo = new PDO("mysql:dbname=projeto_reservas;host=localhost","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Erro: ".$ex->getMessage());
}