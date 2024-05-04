<?php
    require_once('connection.php');

    if (!isset($_POST['SalespersonID']) || !isset($_POST['UserID']) || !isset($_POST['FullName']) || !isset($_POST['GmailAddress']) || !isset($_POST['Avatar']) || !isset($_POST['IsActive']) || !isset($_POST['SalespersonRole'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['SalespersonID'];
    $uid = $_POST['UserID'];
    $name = $_POST['FullName'];
    $gmail = $_POST['GmailAddress'];
    $avatar = $_POST['Avatar'];
    $is_active = $_POST['IsActive'];
    $role = $_POST['SalespersonRole'];

    $sql = 'INSERT INTO Salesperson(SalespersonID , UserID, FullName, GmailAddress, Avatar, IsActive, SalespersonRole) VALUES(?,?,?,?,?,?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $uid, $name, $gmail, $avatar,$is_active,$role));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Saleperson successfully added', 'SalespersonID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
