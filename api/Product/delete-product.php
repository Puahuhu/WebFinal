<?php
    require_once ('connection.php');

    if (!isset($_POST['ProductID']) ) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $id = $_POST['ProductID'];

    $sql = 'DELETE FROM Products where ProductID = ?';

    echo "ProductID: " . $id;

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($id));

        $count = $stmt->rowCount();

        if ($count == 1) {
            echo json_encode(array('status' => true, 'data' => 'Product successfully deleted'));
        }else {
            die(json_encode(array('status' => false, 'data' => 'Invalid ProductID')));
        }
    }
    catch(PDOException $ex){
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }

    echo '<script>
            function redirectPage() {
                window.location.href = "../../AdminProdMana.php";
            }
            redirectPage();
        </script>';
?>