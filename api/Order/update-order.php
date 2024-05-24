<?php
    require_once ('connection.php');

    if (!isset($_POST['OrderID']) || !isset($_POST['CustomerID']) || !isset($_POST['SalespersonID']) || !isset($_POST['OrderDate']) || !isset($_POST['TotalAmount'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['OrderID'];
    $cid = $_POST['CustomerID'];
    $sid = $_POST['SalespersonID'];
    $order_date = $_POST['OrderDate'];
    $amount = $_POST['TotalAmount'];

    $sql = 'UPDATE Orders set OrderDate = ?, TotalAmount = ? where OrderID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($order_date,$amount,$id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Order successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>