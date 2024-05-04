<?php
    require_once ('connection.php');

    if (!isset($_POST['CategoryID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CategoryID'];

    $sql = 'DELETE FROM ProductCategories where CategoryID = ?';

    echo "CategoryID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Category successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid CategoryID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>