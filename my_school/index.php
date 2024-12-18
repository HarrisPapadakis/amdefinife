<!doctype html>
<html lang="en">
<?php
  session_start();

  if (!isset($_SESSION["valid_user"]) && $_SESSION["valid_user"] == '')
    header("Location: ./components/modules/login.php");
  else 
    header("Location: ./components/view/prosopiko.php");
?>