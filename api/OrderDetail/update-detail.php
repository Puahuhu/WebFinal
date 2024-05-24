<?php
    require_once ('connection.php');

    if (!isset($_POST['OrderDetailID']) || !isset($_POST['OrderID']) || !isset($_POST['ProductID']) || !isset($_POST['Quantity']) || !isset($_POST['UnitPrice'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $odid = $_POST['OrderDetailID'];
    $oid = $_POST['OrderID'];
    $pid = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];

    $sql = 'UPDATE OrderDetails set Quantity = ?, UnitPrice = ? where OrderDetailID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($quantity,$UnitPrice,$odid));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Order detail successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>