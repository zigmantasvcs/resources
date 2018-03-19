<?php
  if(isset($_SESSION["username"])){
    echo <<<_START
    <li><a href="index.php">Pagrindinis</a></li>
    <li><a href="expenses.php">Išlaidos</a></li>
    <li><a href="about.php">Apie</a></li>
    <li><a href="api/logout.php">Atsijungti</a></li>
_START;
  }
  else{
    echo <<<_START
    <li><a href="index.php">Pagrindinis</a></li>
    <li><a href="register.php">Registracija</a></li>
    <li><a href="login.php">Prisijungti</a></li>
_START;
  }
 ?>
