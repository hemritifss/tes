<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'etudiant') {
  header("Location: login.html");
  exit();
}
