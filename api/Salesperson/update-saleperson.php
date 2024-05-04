<?php
    require_once ('connection.php');

    if (!isset($_POST['SalespersonID']) || !isset($_POST['UserID']) || !isset($_POST['FullName']) || !isset($_POST['GmailAddress']) || !isset($_POST['Avatar']) || !isset($_POST['IsActive']) || !isset($_POST['SalespersonRole'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['SalespersonID'];
    $uid = $_POST['UserID'];
    $name = $_POST['FullName'];
    $gmail = $_POST['GmailAddress'];
    $avatar = $_POST['Avatar'];
    $is_active = $_POST['IsActive'];
    $role = $_POST['SalespersonRole'];

    $sql = 'UPDATE Salesperson set FullName = ?, GmailAddress = ?, Avatar = ?, IsActive = ?, SalespersonRole = ? where SalespersonID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($name,$gmail,$avatar,$is_active,$role,$id));
        $count = $stmt->rowCount();
        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Saleperson successfully updated'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid update')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>