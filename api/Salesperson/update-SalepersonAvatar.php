<?php
    require_once '\xampp\htdocs\WebFinal\connection.php';

    $salespersonID = $_POST["SalespersonID"];
    $avatar = $_FILES["avatarInput"]["name"]; 
    $name = $_POST["Avatar"];

    $target_dir = "/xampp/htdocs/WebFinal/images/";
    $target_file = $target_dir . basename($_FILES["avatarInput"]["name"]);
    move_uploaded_file($_FILES["avatarInput"]["tmp_name"], $target_file);

    $sql = "UPDATE salesperson SET Avatar = :avatar WHERE SalespersonID = :salespersonID";

    try {
        $stmt = $dbCon->prepare($sql);

        $stmt->bindParam(':avatar', $name, PDO::PARAM_STR);
        $stmt->bindParam(':salespersonID', $salespersonID, PDO::PARAM_INT);
        $stmt->execute();

        echo json_encode(array('status' => true, 'message' => 'Avatar updated successfully'));
    } catch(PDOException $ex) {
        echo json_encode(array('status' => false, 'message' => $ex->getMessage()));
    }
?>
