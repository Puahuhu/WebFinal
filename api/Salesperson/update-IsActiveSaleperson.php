<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');
    $salespersonID = $_POST["SalespersonID"];
    $fullName = $_POST["FullName"];
    $isActive = $_POST["IsActive"];

    $sql = "UPDATE salesperson SET IsActive=$isActive WHERE SalespersonID=$salespersonID";

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $data[] = $row;
    }
    echo json_encode(array('status' => true, 'data' => $data));
?>