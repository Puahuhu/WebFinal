<?php
    require_once ('\xampp\htdocs\WebFinal\connection.php');

    if (!isset($_POST['Username']) || !isset($_POST['pwd'])) {
        die(json_encode(array('status' => false, 'data' => 'Parameters not valid')));
    }

    $username = $_POST['Username'];
    $pass = $_POST['pwd'];

    $sql = "UPDATE accounts SET pwd = :pass WHERE Username = :username";

    try {
        $stmt = $dbCon->prepare($sql);

        // Bind các giá trị tham số vào truy vấn
        $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Thực thi truy vấn
        $stmt->execute();

        // Trả về kết quả thành công
        echo json_encode(array('status' => true, 'message' => 'Password updated successfully'));
    } catch(PDOException $ex) {
        // Trả về thông báo lỗi nếu có lỗi xảy ra
        echo json_encode(array('status' => false, 'message' => $ex->getMessage()));
    }
?>
