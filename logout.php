<?php

session_start();
unset($_SESSION['front']);
header('location:login.php');

?>