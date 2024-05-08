<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['SalespersonID']) || !isset($_POST['FullName']) || !isset($_POST['Email']) || !isset($_POST['Avatar']) || !isset($_POST['IsActive'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['SalespersonID'];
    $name = $_POST['FullName'];
    $email = $_POST['Email'];
    $avatar = $_POST['Avatar'];
    $is_active = $_POST['IsActive'];

    $sql = 'UPDATE Salesperson SET FullName = ?, Email = ?, Avatar = ?, IsActive = ? WHERE SalespersonID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name, $email, $avatar, $is_active, $id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Salesperson successfully updated'));
        } else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>
