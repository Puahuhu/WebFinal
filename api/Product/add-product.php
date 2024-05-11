<?php
    require_once('connection.php');

    if (!isset($_POST['ProductID']) || !isset($_POST['Barcode']) || !isset($_POST['ProductName']) || !isset($_POST['ImportPrice']) || !isset($_POST['RetailPrice']) || !isset($_POST['CategoryID']) || !isset($_POST['CreatedDate'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    if (!isset($_FILES['Images']) || !isset($_FILES['Images']['name'])) {   
        die(json_encode(array('status' => false, 'data' => 'Image not provided')));
    }

    if (empty($_POST['Barcode'])) { // Check if Barcode is empty
        $barcode = generateRandomBarcode(); // Generate a new Barcode
    } else {
        $barcode = $_POST['Barcode']; // Use the provided Barcode
    }

    $name = $_POST['ProductName'];
    $import_price = $_POST['ImportPrice'];
    $retail_price = $_POST['RetailPrice'];
    $category = $_POST['CategoryID'];
    $date = $_POST['CreatedDate'];

    $sql = 'INSERT INTO Products(ProductID, Barcode, ProductName, ImportPrice, RetailPrice, CategoryID, CreatedDate) VALUES (?, ?, ?, ?, ?, ?, ?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($pid, $barcode, $name, $import_price, $retail_price, $category, $date));

        $lastInsertedId = $dbCon->lastInsertId();
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>