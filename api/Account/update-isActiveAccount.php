<?php
    require_once ('connection.php');

    $username = $_POST['Username'];
    $sql = 'SELECT * FROM accounts';
    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute();
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }

    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    foreach ($data as $account) {
        if ($account['Username'] === $username) {
            $isActive = $account['IsActive'];
            if ($isActive == 0) {
                $updateIsActive = 'UPDATE accounts SET IsActive = 1 WHERE Username = :username';
                try {
                    $stmt = $dbCon->prepare($updateIsActive);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();
                } catch (PDOException $ex) {
                    die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
                }
            }
        }
    }                
?>