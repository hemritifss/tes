<?php
$host = "localhost";
$base = "bdd_iit";
$user = "root";
$pass = "";

try {
    $cnx = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
