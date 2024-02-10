<?php

session_start();
unset($_SESSION['backend']);
header('location:login.php');

?>