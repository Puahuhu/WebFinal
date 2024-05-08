<?php
    require('api/Product/connection.php');

    if (!isset($_POST['CustomerID']) || !isset($_POST['FullName']) || !isset($_POST['Phone']) || !isset($_POST['CustomerAddress']) || !isset($_POST['UserID'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CustomerID'];
    $name = $_POST['FullName'];
    $phone = $_POST['Phone'];
    $add = $_POST['CustomerAddress'];
    $uid = $_POST['UserID'];

    $sql = 'INSERT INTO Customers(CustomerID , FullName, Phone, CustomerAddress, UserID) VALUES(?,?,?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $name, $phone, $add, $uid));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Customer successfully added', 'CustomerID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>