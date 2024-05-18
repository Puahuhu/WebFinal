<?php
    require_once ('connection.php');

    if (!isset($_POST['SalespersonID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['SalespersonID'];

    $sql = 'DELETE FROM Salesperson where SalespersonID = ?';

    echo "SalespersonID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Salesperson successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid SalespersonID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>