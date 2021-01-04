<?php
  require 'conn.php';
  session_start();

  unset($_SESSION['cart']);
  unset($_SESSION['user']);
  message("Anda Berhasil Logout");
  redirect("index.php");
?>
