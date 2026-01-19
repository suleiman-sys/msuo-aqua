<?php
session_start();

/*
  Hakikisha admin amelogin
*/
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit;
}

/*
  CSRF token (inatumika kwa forms zote)
*/
if (empty($_SESSION["csrf_token"])) {
  $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
}
