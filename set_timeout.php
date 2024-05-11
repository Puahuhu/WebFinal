<?php
session_start();

// Thiết lập thời gian timeout là 60 giây
$_SESSION['timeout'] = time() + 60;

echo "Timeout has been set to 60 seconds.";
?>