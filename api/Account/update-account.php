<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['UserID']) || !isset($_POST['Username']) || !isset($_POST['Email']) || !isset($_POST['pwd']) || !isset($_POST['IsActive'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['UserID'];
    $name = $_POST['Username'];
    $email = $_POST['Email'];
    $pwd = $_POST['pwd'];
    $IsActive = $_POST['IsActive'];

    $sql = 'UPDATE Account set Username = ?, Email = ?, pwd = ?, IsActive = ? where UserID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name,$email,$pwd,$IsActive,$id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Account successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>