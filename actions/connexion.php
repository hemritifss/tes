<?php
$host = "localhost";
$base = "bdd_iit";
$user = "root";
$pass = "";

try {
    $cnx = new PDO("mysql:host=$host;dbname=$base;charset=utf8mb4", $user, $pass);
    $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
