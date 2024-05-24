<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['UserID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['UserID'];

    $sql = 'DELETE FROM Account where UserID = ?';

    echo "UserID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Account successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid UserID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>