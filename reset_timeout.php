<?php
    session_start();
    require_once("connection.php");

    $_SESSION['last_activity'] = time() + 60;

    if(isset($_GET['fullName'])){
        $fullName = $_GET['fullName'];
        
        $stmt = $dbCon->prepare("SELECT Email FROM salesperson WHERE FullName = ?");
        $stmt->execute([$fullName]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $email = $row['Email'];

            $subject = 'Reload the login page';
            $body = 'Request to reload your approved page<br><br>'
                    . 'Login link here: http://localhost/WebFinal/FirstLogin.php';
            
            require("send-email.php");

            echo "Email sent successfully!";
        } else {
            echo "Salesperson not found!";
        }
    } else {
        echo "FullName not provided!";
    }
?>