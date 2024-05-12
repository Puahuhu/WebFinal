<?php
    require_once('connection.php');

    function generateRandomBarcode($length = 6) {
        $numbers = '0123456789';
        return substr(str_shuffle($numbers), 0, $length);
    }

    if (!isset($_POST['ProductName']) || !isset($_POST['ImportPrice']) || !isset($_POST['RetailPrice']) || !isset($_POST['CategoryID']) || !isset($_POST['CreatedDate'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    if (!isset($_FILES['Images']) || !isset($_FILES['Images']['name'])) {   
        die(json_encode(array('status' => false, 'data' => 'Image not provided')));
    }

    if (empty($_POST['Barcode'])) { // Check if Barcode is empty
        $barcode = generateRandomBarcode(); // Generate a new Barcode
    } else {
        $barcode = $_POST['Barcode']; // Use the provided Barcode
    }

    $name = $_POST['ProductName'];
    $import_price = $_POST['ImportPrice'];
    $retail_price = $_POST['RetailPrice'];
    $category = $_POST['CategoryID'];
    $date = $_POST['CreatedDate'];

    $target_dir = "/xampp/htdocs/WebFinal/images/";
    $target_file = $target_dir . basename($_FILES["Images"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        die(json_encode(array('status' => false, 'data' => 'Only JPG, JPEG, PNG files are allowed')));
    }

    move_uploaded_file($_FILES["Images"]["tmp_name"], $target_file);

    $image = "images/" . basename($_FILES["Images"]["name"]);

    $sql = 'INSERT INTO Products(Barcode, ProductName, ImportPrice, RetailPrice, CategoryID, CreatedDate, Images) VALUES (?, ?, ?, ?, ?, ?, ?)';

    try {
        $stmt = $dbCon->prepare($sql);
        $stmt->execute(array($barcode, $name, $import_price, $retail_price, $category, $date, $image));
        $lastInsertedId = $dbCon->lastInsertId();
    } catch (PDOException $ex) {
        die(json_encode(array('status' => false, 'data' => $ex->getMessage())));
    }
    echo '<script>
            function redirectPage() {
                window.location.href = "../../AdminProdMana.php";
            }
            redirectPage();
        </script>';
?>