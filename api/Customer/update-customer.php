<?php
    require_once ('connection.php');

    if (!isset($_POST['CustomerID']) || !isset($_POST['FullName']) || !isset($_POST['Phone']) || !isset($_POST['CustomerAddress']) || !isset($_POST['UserID'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CustomerID'];
    $name = $_POST['FullName'];
    $phone = $_POST['Phone'];
    $add = $_POST['CustomerAddress'];
    $uid = $_POST['UserID'];

    $sql = 'UPDATE Customers set FullName = ?, Phone = ?, CustomerAddress = ? where UserID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name,$email,$phone,$id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Customer successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>