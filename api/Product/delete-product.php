<?php
require_once('connection.php');

// Check if ProductID is set in the POST request
if (!isset($_POST['ProductID'])) {
    die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
}

$id = $_POST['ProductID'];

$sql = 'DELETE FROM Products WHERE ProductID = ?';

try {
    $stmt = $dbCon->prepare($sql);
    $stmt->execute(array($id));

    $count = $stmt->rowCount();

    if ($count == 1) {
        echo json_encode(array('status' => true, 'data' => 'Product successfully deleted'));
        echo '<script>
            function redirectPage() {
                window.location.href = "../../AdminProdMana.php";
            }
            redirectPage();
        </script>';
    } else {
        echo json_encode(array('status' => false, 'data' => 'Failed to delete product. Product may not exist.'));
    }
} catch (PDOException $ex) {
    // Check if the error is due to foreign key constraint violation
    if ($ex->errorInfo[1] == 1451) {
        echo json_encode(array('status' => false, 'data' => 'Cannot delete product. It is associated with orders.'));
        echo '<script>alert("Cannot delete product. It is associated with orders."); window.location.href = "../../AdminProdMana.php";</script>';
    } else {
        json_encode(array('status' => false, 'data' => $ex->getMessage()));
        
    }
    
}
?>
