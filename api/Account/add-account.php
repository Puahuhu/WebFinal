<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['Username']) || !isset($_POST['pwd']) || !isset($_POST['IsActive'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $name = $_POST['Username'];
    $pwd = $_POST['pwd'];

    $sql = 'INSERT INTO Account(Username, pwd, IsActive) VALUES(?,?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $name, $pwd, 0));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Account successfully added', 'UserID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
