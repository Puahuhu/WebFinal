
<?php
    // Kết nối đến cơ sở dữ liệu và thực hiện truy vấn tìm kiếm dựa trên tham số 'q'
    // Sau đó trả về kết quả dưới dạng JSON

    // Example:
    $conn = mysqli_connect("localhost", "root", "", "finalweb");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $searchQuery = $_POST['q'];
    $sql = "SELECT * FROM salesperson WHERE FullName LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    $account = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $account[] = $row;
        }
    }

    echo json_encode($account);
?>