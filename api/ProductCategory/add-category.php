<?php
    require_once('connection.php');

    if (!isset($_POST['CategoryID']) || !isset($_POST['CategoryName'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CategoryID'];
    $name = $_POST['CategoryName'];

    $sql = 'INSERT INTO ProductCategories(CategoryID , CategoryName) VALUES(?,?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id, $name));

        $lastInsertedId = $dbCon->lastInsertId();

        echo json_encode(array('status' => true, 'data' => array('message' => 'Category successfully added', 'CategoryID' => $lastInsertedId)));
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
