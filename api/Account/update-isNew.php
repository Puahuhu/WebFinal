<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['Username'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }
    $sql = 'SELECT * FROM Accounts';

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

    $username = $_POST['Username'];

    foreach ($data as $account) {
        if ($account['Username'] === $username) {
            $userid = $account['UserID'];
            $updateIsActive = 'UPDATE salesperson SET IsNew = 0 WHERE UserID = :userid';

            try {
                $stmt = $dbCon->prepare($updateIsActive);
                $stmt->bindParam(':userid', $userid);
                $stmt->execute();
            } catch (PDOException $ex) {
                die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
            }
            
        }
    }   

?>
