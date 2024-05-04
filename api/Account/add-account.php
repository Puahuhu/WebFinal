<?php
    require_once('connection.php');

    if (!isset($_POST['UserID']) || !isset($_POST['Username']) || !isset($_POST['Email']) || !isset($_POST['pwd']) || !isset($_POST['IsActive'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['UserID'];
    $name = $_POST['Username'];
    $email = $_POST['Email'];
    $pwd = $_POST['pwd'];
    $IsActive = $_POST['IsActive'];

    $sql = 'INSERT INTO Account(UserID , Username, Email, pwd, IsActive) VALUES(?,?,?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $name, $email, $pwd, $IsActive));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Account successfully added', 'UserID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
