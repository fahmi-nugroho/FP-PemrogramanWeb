<?php
  require 'conn.php';
  session_start();

  unset($_SESSION['cart']);
  unset($_SESSION['user']);
  redirect("index.php");
?>
