<?php
    require_once('connection.php');

    if (!isset($_POST['ProductID']) || !isset($_POST['Barcode']) || !isset($_POST['ImportPrice']) || !isset($_POST['RetailPrice']) || !isset($_POST['CategoryID']) || !isset($_POST['CreatedDate'])) {
        // die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
        echo '<script>alert("Not change."); window.location.href = "../../../AdminProdMana.php";</script>';
    }

    $pid = $_POST['ProductID'];
    $barcode = $_POST['Barcode'];
    $name = $_POST['ProductName'];
    $imort_price = $_POST['ImportPrice'];
    $retail_price = $_POST['RetailPrice'];
    $category = $_POST['CategoryID'];
    $date = $_POST['CreatedDate'];


    $sql = 'UPDATE Products set Barcode = ?, ImportPrice = ?, RetailPrice = ? ,CategoryID=? ,CreatedDate=? where ProductID = ?';

    try{
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($barcode,$imort_price,$retail_price,$category,$date,$pid));
        $count = $stmt->rowCount();
        if ($count == 1) {  
            echo '<script>
                alert("Product updated succesfully.");
                function redirectPage() {
                    window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';

        }else {
            // die(json_encode(array('status' => false, 'data' => 'Invalid update')));
            echo '<script>
                
                function redirectPage() {
                    window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';
        }
    }
    catch(PDOException $ex){
        // json_encode(array('status' => false, 'data' => $ex->getMessage())));
        echo '<script>
                function redirectPage() {
                    window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';
    }
    echo '<script>
                function redirectPage() {
                    window.location.href = "../../admin/ProductMana/AdminProdMana.php?username=' . $_POST['username'] . '";
                }
                redirectPage();
            </script>';
   


?>