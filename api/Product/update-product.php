<?php
    require_once ('connection.php');

    if (!isset($_POST['ProductID']) || !isset($_POST['Barcode']) || !isset($_POST['ProductName']) || !isset($_POST['ImportPrice']) || !isset($_POST['RetailPrice']) || !isset($_POST['Category']) || !isset($_POST['CreatedDate'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $pid = $_POST['ProductID'];
    $barcode = $_POST['Barcode'];
    $name = $_POST['ProductName'];
    $imort_price = $_POST['ImportPrice'];
    $retail_price = $_POST['RetailPrice'];
    $category = $_POST['Category'];
    $date = $_POST['CreatedDate'];


    $sql = 'UPDATE Products set Barcode = ?, ImportPrice = ?, RetailPrice = ?, Category = ?, CreatedDate = ? where ProductID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($barcode,$imort_price,$retail_price,$category,$date,$pid));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Product successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>