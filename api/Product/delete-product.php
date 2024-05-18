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
        echo '<script>
                alert("Product deleted succesfully.");
                function redirectPage() {
                    window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';
        echo json_encode(array('status' => true, 'data' => 'Product deleted succesfully.'));
    } else {
        echo json_encode(array('status' => false, 'data' => 'Failed to delete product. Product may not exist.'));
    }
} catch (PDOException $ex) {
    // Check if the error is due to foreign key constraint violation
    if ($ex->errorInfo[1] == 1451) {
        echo '<script>alert("Cannot delete product. It is associated with orders."); 
        window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";</script>';
        echo json_encode(array('status' => false, 'data' => 'Cannot delete product. It is associated with orders.'));
    } else {
        json_encode(array('status' => false, 'data' => $ex->getMessage()));
        
    }
    
}
?>
