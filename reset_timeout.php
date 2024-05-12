<?php
    session_start();

    $_SESSION['last_activity'] = time() + 60;

    echo "Timeout has been set to 60 seconds.";
    
    $subject = 'Reload the login page';
    $body = 'Request to reload your approved page<br><br>'
            . 'Login link here: http://localhost/WebFinal/FirstLogin.php';
    require("send-email.php");
?>