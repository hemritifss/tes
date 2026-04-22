<?php
require "actions/connexion.php";
session_start();
$_SESSION['user'] = $user;

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND mot_de_passe='$password'";
$result = $cnx->query($sql);

if ($result->rowCount() > 0) {
  $user = $result->fetch();

  if ($user['role'] == 'admin') {
    header("Location:admin.php");
    exit();
  } else {
    header("Location:  dashboard.php");
    exit();
  }
} else {
  echo "Email ou mot de passe incorrect";
}
