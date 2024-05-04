<?php
    require_once ('connection.php');

    if (!isset($_POST['OrderID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['OrderID'];

    $sql = 'DELETE FROM Orders where OrderID = ?';

    echo "OrderID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Order successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid OrderID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>