<?php 
    if(!isset($_SESSION['logged in'])) {
        header("Location: layout/AdminLogin.php");
    }
?>