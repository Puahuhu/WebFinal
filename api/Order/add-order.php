<?php
    require_once('connection.php');

    if (!isset($_POST['OrderID']) || !isset($_POST['CustomerID']) || !isset($_POST['SalespersonID']) || !isset($_POST['OrderDate']) || !isset($_POST['TotalAmount']) || !isset($_POST['MoneyGiven']) || !isset($_POST['MoneyBack'])){
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['OrderID'];
    $cid = $_POST['CustomerID'];
    $sid = $_POST['SalespersonID'];
    $order_date = $_POST['OrderDate'];
    $amount = $_POST['TotalAmount'];
    $moneygive = $_POST['MoneyGiven'];
    $moneyback = $_POST['MoneyBack'];

    $sql = 'INSERT INTO Orders(OrderID , CustomerID, SalespersonID, OrderDate, TotalAmount, MoneyGiven, MoneyBack) VALUES(?,?,?,?,?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $cid, $sid, $order_date, $amount, $moneygive, $moneyback));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Order successfully added', 'OrderID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
