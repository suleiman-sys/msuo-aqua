<?php
session_start();

/*
  LOGIN YA MUDA (LEARNING PURPOSE)
  Tutaibadilisha baadaye kuwa DB + password_hash
*/
$ADMIN_USER = "admin";
$ADMIN_PASS = "12345";

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === $ADMIN_USER && $password === $ADMIN_PASS) {
  $_SESSION['admin_logged_in'] = true;
  header("Location: add-product.php");
  exit;
}

header("Location: login.php?error=1");
exit;
