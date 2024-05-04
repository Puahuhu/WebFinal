<?php
    require_once ('connection.php');

    if (!isset($_POST['CustomerID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CustomerID'];

    $sql = 'DELETE FROM Customers where CustomerID = ?';

    echo "CustomerID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Customer successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid CustomerID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>