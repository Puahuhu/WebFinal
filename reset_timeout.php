<?php
    session_start();
    $_SESSION['last_activity'] = time();
    header("Location: SalesLogin.php");
?>