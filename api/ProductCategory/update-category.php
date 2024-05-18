<?php
    require_once ('connection.php');

    if (!isset($_POST['CategoryID']) || !isset($_POST['CategoryName'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['CategoryID'];
    $name = $_POST['CategoryName'];

    $sql = 'UPDATE ProductCategories set CategoryName = ? where CategoryID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name,$id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Category successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>