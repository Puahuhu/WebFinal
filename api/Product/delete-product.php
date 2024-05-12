<?php

    require_once ('connection.php');

    if (!isset($_POST['ProductID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['ProductID'];

    $sql = 'DELETE FROM Products where ProductID = ?';


    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo '<script>
                function redirectPage() {
                    window.location.href = "../../AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid ProductID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
?>