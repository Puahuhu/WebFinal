<?php
    require_once('connection.php');

    if (!isset($_POST['OrderDetailID']) || !isset($_POST['OrderID']) || !isset($_POST['ProductID']) || !isset($_POST['Quantity']) || !isset($_POST['UnitPrice'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $odid = $_POST['OrderDetailID'];
    $oid = $_POST['OrderID'];
    $pid = $_POST['ProductID'];
    $quantity = $_POST['Quantity'];
    $UnitPrice = $_POST['UnitPrice'];

    $sql = 'INSERT INTO OrderDetails(OrderDetailID , OrderID, ProductID, Quantity, UnitPrice) VALUES(?,?,?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($odid, $oid, $pid, $quantity, $UnitPrice));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Order detail successfully added', 'OrderDetailID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
