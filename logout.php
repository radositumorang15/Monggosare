<?php
session_start();
unset($_SESSION["guest"]);
header("location:index.php");
?>