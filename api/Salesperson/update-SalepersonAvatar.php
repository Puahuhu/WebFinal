<?php
    require_once '\xampp\htdocs\WebFinal\connection.php';

    // Lấy dữ liệu từ request POST
    $salespersonID = $_POST["SalespersonID"];
    $avatar = $_POST["Avatar"];

    // Sử dụng truy vấn prepared statement để tránh SQL Injection
    $sql = "UPDATE salesperson SET Avatar = :avatar WHERE SalespersonID = :salespersonID";

    try {
        $stmt = $dbCon->prepare($sql);

        // Bind các giá trị tham số vào truy vấn
        $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $stmt->bindParam(':salespersonID', $salespersonID, PDO::PARAM_INT);

        // Thực thi truy vấn
        $stmt->execute();

        // Trả về kết quả thành công
        echo json_encode(array('status' => true, 'message' => 'Avatar updated successfully'));
    } catch(PDOException $ex) {
        // Trả về thông báo lỗi nếu có lỗi xảy ra
        echo json_encode(array('status' => false, 'message' => $ex->getMessage()));
    }
?>
